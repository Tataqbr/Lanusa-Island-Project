<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Mail\MembershipConfirmation;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
   public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Update payment gateway data dari admin
     */
    public function editGateway(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Validation failed!');
        }

        try {
            DB::table('payment_gateways')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'code' => $request->code,
                    'status' => $request->status,
                    'updated_at' => now(),
                ]);

            return back()->with('success', 'Payment gateway updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update payment gateway: ' . $e->getMessage());
        }
    }

    /**
     * Delete payment gateway
     */
    public function deleteGateway($id)
    {
        try {
            $gateway = DB::table('payment_gateways')->where('id', $id)->first();
            if (!$gateway) {
                return back()->with('error', 'Payment gateway not found!');
            }

            DB::table('payment_gateways')->where('id', $id)->delete();
            return back()->with('success', 'Payment gateway deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete payment gateway: ' . $e->getMessage());
        }
    }

    /**
     * Toggle gateway status (Active/Inactive)
     */
    public function toggleStatus($id)
    {
        try {
            $gateway = DB::table('payment_gateways')->where('id', $id)->first();
            if (!$gateway) {
                return back()->with('error', 'Payment gateway not found!');
            }

            $newStatus = $gateway->status === 'active' ? 'inactive' : 'active';

            DB::table('payment_gateways')
                ->where('id', $id)
                ->update([
                    'status' => $newStatus,
                    'updated_at' => now()
                ]);

            return back()->with('success', "Payment gateway status updated to {$newStatus}!");
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update gateway status: ' . $e->getMessage());
        }
    }

    /**
     * INITIALIZE PAYMENT (AUTOMATIC DETECTION)
     */
    public function pay(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'state' => 'required|string',
            'plan_id' => 'required|exists:membership,id',
        ]);

        $activeGateway = DB::table('payment_gateways')->where('status', 'active')->first();

        if (!$activeGateway) {
            return response()->json(['success' => false, 'message' => 'No active payment method.'], 500);
        }

        $user = DB::table('users')->where('email', $request->email)->first();
        if ($user && ($user->status === 'success' || $user->status === 'paid')) {
            return response()->json(['success' => false, 'message' => 'Email already registered.'], 422);
        }

        DB::beginTransaction();
        try {
            $plan = DB::table('membership')->where('id', $request->plan_id)->first();
            $transactionId = 'LNS-' . strtoupper(Str::random(10));

            // UPSERT USER
            if ($user) {
                $userId = $user->id;
                DB::table('users')->where('id', $userId)->update([
                    'name' => $request->name, 'phone' => $request->phone,
                    'state' => strtoupper($request->state), 'membership_id' => $plan->id,
                    'status' => 'pending', 'updated_at' => now()
                ]);
            } else {
                $userId = DB::table('users')->insertGetId([
                    'name' => $request->name, 'email' => $request->email, 'phone' => $request->phone,
                    'state' => strtoupper($request->state), 'membership_id' => $plan->id,
                    'status' => 'pending', 'access_code' => $this->generateAccessCode(),
                    'created_at' => now(), 'updated_at' => now()
                ]);
            }

            DB::table('registrations')->insert([
                'user_id' => $userId, 'method' => $activeGateway->code, 
                'status' => 'pending', 'transaction_id' => $transactionId,
                'amount' => (int) $plan->price, 'created_at' => now(), 'updated_at' => now()
            ]);

            // --- LOGIKA MIDTRANS ---
            if ($activeGateway->code === 'midtrans') {
                $params = [
                    'transaction_details' => ['order_id' => $transactionId, 'gross_amount' => (int) $plan->price],
                    'customer_details' => ['first_name' => $request->name, 'email' => $request->email, 'phone' => $request->phone],
                ];
                $snapToken = Snap::getSnapToken($params);
                DB::commit();
                return response()->json(['success' => true, 'type' => 'midtrans', 'snap_token' => $snapToken, 'transaction_id' => $transactionId]);
            } 
            
            // --- LOGIKA XENDIT (FIXED) ---
            else if ($activeGateway->code === 'xendit') {
                $secretKey = env('XENDIT_SECRET_KEY');
                
                // Hit API Xendit untuk buat Invoice
                $response = Http::withHeaders([
                    'Authorization' => 'Basic ' . base64_encode($secretKey . ':'),
                ])->post('https://api.xendit.co/v2/invoices', [
                    'external_id' => $transactionId,
                    'amount' => (int) $plan->price,
                    'payer_email' => $request->email,
                    'description' => 'Lanusa Membership: ' . $plan->type,
                    'success_redirect_url' => route('payment.success', ['order_id' => $transactionId]),
                    'failure_redirect_url' => route('payment.fail'),
                ]);

                if ($response->successful()) {
                    $invoiceData = $response->json();
                    DB::commit();
                    return response()->json([
                        'success' => true,
                        'type' => 'xendit',
                        'invoice_url' => $invoiceData['invoice_url'] // URL ASLI DARI XENDIT
                    ]);
                } else {
                    throw new \Exception('Xendit Error: ' . $response->body());
                }
            }

            // --- LOGIKA MANUAL ---
            else if ($activeGateway->code === 'bank_transfer' || $activeGateway->code === 'manual') {
                DB::commit();
                return response()->json(['success' => true, 'type' => 'manual', 'transaction_id' => $transactionId]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Helper untuk update status agar kode tidak duplikat
    private function markTransactionSuccess($orderId, $userId) {
        DB::table('registrations')->where('transaction_id', $orderId)->update(['status' => 'success', 'updated_at' => now()]);
        DB::table('users')->where('id', $userId)->update(['status' => 'success', 'updated_at' => now()]);
        $this->sendConfirmationEmail($orderId);
    }

    /**
     * MANUAL BANK TRANSFER: Upload Proof
     */
    public function uploadProof(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required',
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $path = $request->file('proof')->store('payment_proofs', 'public');

            DB::table('registrations')
                ->where('transaction_id', $request->transaction_id)
                ->update([
                    'method' => 'transfer_bank',
                    'payment_data' => json_encode(['proof_path' => $path]),
                    'status' => 'waiting_verification',
                    'updated_at' => now()
                ]);

            return redirect()->route('payment.success', ['order_id' => $request->transaction_id])
                             ->with('message', 'Proof uploaded successfully. Admin will verify soon.');
        } catch (\Exception $e) {
            Log::error('Upload Proof Failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to upload proof.');
        }
    }

    /**
     * SUCCESS PAGE HANDLER
     */
/**
     * SUCCESS PAGE HANDLER (DENGAN AUTO-CHECK XENDIT & MIDTRANS)
     */
    public function paymentSuccessPage(Request $request)
    {
        $orderId = $request->query('order_id');
        $userData = null;

        if ($orderId) {
            $reg = DB::table('registrations')->where('transaction_id', $orderId)->first();
            
            if ($reg) {
                // JIKA STATUS MASIH PENDING, PAKSA CEK KE API GATEWAY
                if ($reg->status !== 'success') {
                    
                    // --- CEK REAL-TIME KE XENDIT ---
                    if ($reg->method === 'xendit') {
                        try {
                            $secretKey = env('XENDIT_SECRET_KEY');
                            $response = Http::withHeaders([
                                'Authorization' => 'Basic ' . base64_encode($secretKey . ':'),
                            ])->get("https://api.xendit.co/v2/invoices?external_id=$orderId");

                            if ($response->successful()) {
                                $invoices = $response->json();
                                // Xendit Invoice v2 mengembalikan Array. Kita ambil index pertama [0]
                                if (isset($invoices[0]) && ($invoices[0]['status'] === 'PAID' || $invoices[0]['status'] === 'SETTLED')) {
                                    $this->markTransactionSuccess($orderId, $reg->user_id);
                                }
                            }
                        } catch (\Exception $e) {
                            Log::error("Xendit Auto-Check Failed: " . $e->getMessage());
                        }
                    }

                    // --- CEK REAL-TIME KE MIDTRANS ---
                    else if ($reg->method === 'midtrans') {
                        try {
                            $status = Transaction::status($orderId);
                            if (in_array($status->transaction_status, ['settlement', 'capture'])) {
                                $this->markTransactionSuccess($orderId, $reg->user_id);
                            }
                        } catch (\Exception $e) {
                            Log::error("Midtrans Auto-Check Failed: " . $e->getMessage());
                        }
                    }
                }

                // Ambil data terbaru setelah pengecekan di atas
                $userData = DB::table('users')
                    ->join('membership', 'users.membership_id', '=', 'membership.id')
                    ->where('users.id', $reg->user_id)
                    ->select('users.*', 'membership.type as plan_name', 'membership.contract')
                    ->first();
            }
        }

        return view('payment.success', compact('orderId', 'userData'));
    }

    /**
     * XENDIT CALLBACK (WEBHOOK)
     */
    public function xenditCallback(Request $request)
    {
        $payload = $request->all();
        $externalId = $payload['external_id'] ?? null;
        $status = $payload['status'] ?? null;

        Log::info("Xendit Webhook Received: ID $externalId Status $status");

        if ($externalId && ($status === 'PAID' || $status === 'SETTLED')) {
            $reg = DB::table('registrations')->where('transaction_id', $externalId)->first();
            if ($reg && $reg->status !== 'success') {
                $this->markTransactionSuccess($externalId, $reg->user_id);
                return response()->json(['message' => 'Success updated']);
            }
        }

        return response()->json(['message' => 'No action taken']);
    }

    /**
     * MIDTRANS WEBHOOK (BACKUP)
     */
    public function midtransCallback(Request $request)
    {
        $payload = $request->all();
        $orderId = $payload['order_id'];
        $transactionStatus = $payload['transaction_status'];

        $reg = DB::table('registrations')->where('transaction_id', $orderId)->first();
        
        if ($reg && $reg->status !== 'success') {
            if (in_array($transactionStatus, ['settlement', 'capture'])) {
                DB::beginTransaction();
                try {
                    DB::table('registrations')->where('transaction_id', $orderId)->update(['status' => 'success', 'updated_at' => now()]);
                    DB::table('users')->where('id', $reg->user_id)->update(['status' => 'success', 'updated_at' => now()]);
                    DB::commit();
                    $this->sendConfirmationEmail($orderId);
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error("Webhook DB Error: " . $e->getMessage());
                }
            }
        }
        return response()->json(['status' => 'OK']);
    }


    private function generateAccessCode() {
        do { $code = 'ACC-' . strtoupper(Str::random(8)); } 
        while (DB::table('users')->where('access_code', $code)->exists());
        return $code;
    }

    private function sendConfirmationEmail($transactionId) {
        $data = DB::table('registrations')
            ->join('users', 'registrations.user_id', '=', 'users.id')
            ->join('membership', 'users.membership_id', '=', 'membership.id')
            ->where('registrations.transaction_id', $transactionId)
            ->select('users.name', 'users.email', 'users.access_code', 'membership.type as plan_name')
            ->first();

        if ($data) {
            try {
                Mail::to($data->email)->bcc('admin-lanusa@gmail.com')->send(new MembershipConfirmation($data));
            } catch (\Exception $e) { 
                Log::error("Email failed for $transactionId: " . $e->getMessage()); 
            }
        }
    }

    public function fail(Request $request) { return view('payment.fail'); }

    public function downloadCertificate($orderId)
    {
        $data = DB::table('registrations')
            ->join('users', 'registrations.user_id', '=', 'users.id')
            ->join('membership', 'users.membership_id', '=', 'membership.id')
            ->where('registrations.transaction_id', $orderId)
            ->where('registrations.status', 'success')
            ->select('users.*', 'membership.type as plan_name', 'membership.features', 'membership.contract', 'registrations.amount', 'registrations.transaction_id', 'registrations.created_at as join_date')
            ->first();

        if (!$data) return abort(404);

        $data->features = json_decode($data->features, true) ?? [];
        $logoData = "";
        $path = public_path('assets/logo.png'); 
        if (file_exists($path)) {
            $logoData = 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path));
        }

        $pdf = Pdf::loadView('pdf.certificate_pdf', ['data' => $data, 'logo' => $logoData])->setPaper('a4', 'portrait');
        return $pdf->download('Lanusa_Asset_'.$orderId.'.pdf');
    }
}