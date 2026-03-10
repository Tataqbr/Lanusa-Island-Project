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

class BookingController extends Controller
{
     public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Verifikasi kode akses member
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'access_code' => 'required|string',
            'resort_id' => 'required|exists:resorts,id'
        ]);

        // Cari user yang statusnya success/paid dan punya access_code tersebut
        $user = DB::table('users')
                    ->where('access_code', $request->access_code)
                    ->whereIn('status', ['success', 'paid'])
                    ->first();

        if (!$user) {
            return response()->json([
                'success' => false, 
                'message' => 'Invalid Access Code or Membership is inactive.'
            ]);
        }

        // Jika berhasil, berikan URL ke halaman form booking
        return response()->json([
            'success' => true,
            'redirect_url' => route('booking.checkout', [
                'resort_id' => $request->resort_id, 
                'user_id' => $user->id
            ])
        ]);
    }

    /**
     * Tampilkan halaman detail durasi inap & konfirmasi harga
     */
        public function checkout($resort_id, $user_id)
        {
            // Ambil data resort dan user
            $resort = DB::table('resorts')->where('id', $resort_id)->first();
            $user = DB::table('users')->where('id', $user_id)->first();

            // Proteksi: Jika user belum sukses membership-nya, tendang balik
            if (!$user || !in_array($user->status, ['success', 'paid'])) {
                return redirect()->route('pricing')->with('error', 'Active membership required.');
            }

            if (!$resort) return abort(404);

            return view('guest.checkout', compact('resort', 'user'));
        }

    public function store(Request $request)
{
    $request->validate([
        'resort_id' => 'required|exists:resorts,id',
        'user_id' => 'required|exists:users,id',
        'stay_duration' => 'required|integer|min:1',
    ]);

    // 1. Ambil Gateway yang sedang AKTIF
    $activeGateway = DB::table('payment_gateways')->where('status', 'active')->first();

    if (!$activeGateway) {
        return response()->json(['success' => false, 'message' => 'No active payment method.'], 500);
    }

    $resort = DB::table('resorts')->where('id', $request->resort_id)->first();
    $user = DB::table('users')->where('id', $request->user_id)->first();
    
    $totalAmount = (int) ($resort->price * $request->stay_duration);
    $transactionId = 'BK-' . strtoupper(Str::random(10));

    DB::beginTransaction();
    try {
        // 2. Insert ke tabel bookings
        DB::table('bookings')->insert([
            'transaction_id' => $transactionId,
            'user_id' => $user->id,
            'resort_id' => $resort->id,
            'stay_duration' => $request->stay_duration,
            'amount' => $totalAmount,
            'method' => $activeGateway->code, // Otomatis ambil dari gateway aktif
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // --- LOGIKA MIDTRANS ---
        if ($activeGateway->code === 'midtrans') {
            $params = [
                'transaction_details' => ['order_id' => $transactionId, 'gross_amount' => $totalAmount],
                'customer_details' => [
                    'first_name' => $user->name, 
                    'email' => $user->email, 
                    'phone' => $user->phone
                ],
            ];
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            DB::commit();
            return response()->json([
                'success' => true, 
                'type' => 'midtrans', 
                'snap_token' => $snapToken, 
                'transaction_id' => $transactionId
            ]);
        } 
        
        // --- LOGIKA XENDIT ---
        else if ($activeGateway->code === 'xendit') {
            $secretKey = env('XENDIT_SECRET_KEY');
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($secretKey . ':'),
            ])->post('https://api.xendit.co/v2/invoices', [
                'external_id' => $transactionId,
                'amount' => $totalAmount,
                'payer_email' => $user->email,
                'description' => 'Booking Resort: ' . $resort->name,
                'success_redirect_url' => route('booking.success', ['order_id' => $transactionId]),
                'failure_redirect_url' => route('resorts.show', $resort->id),
            ]);

            if ($response->successful()) {
                $invoiceData = $response->json();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'type' => 'xendit',
                    'invoice_url' => $invoiceData['invoice_url']
                ]);
            } else {
                throw new \Exception('Xendit Error: ' . $response->body());
            }
        }

        // --- LOGIKA MANUAL ---
        else if ($activeGateway->code === 'bank_transfer' || $activeGateway->code === 'manual') {
            DB::commit();
            return response()->json([
                'success' => true, 
                'type' => 'manual', 
                'transaction_id' => $transactionId
            ]);
        }

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Booking Payment Error: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}
}