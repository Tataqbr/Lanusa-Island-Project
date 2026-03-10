<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserAccountCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Mail\PaymentApproved;
use App\Mail\PaymentRejected;

class SuperAdminController extends Controller
{
    public function Dashboard()
    {
        $totalAdmin = DB::table('admins')->count();
        $totalMember = DB::table('users')->where('status', 'Paid')->count();
        $totalDestination = DB::table('destinations')->count();
        $totalResort = DB::table('resorts')->count();
        $notPaid = DB::table('users')->where('status', 'Not Paid')->count();
        $requestAdmin = DB::table('requests')->where('role', 'Admin')->count();
        $requestUser = DB::table('requests')->where('role', 'User')->count();

        $dataReqAdmin = DB::table('requests')
                        ->leftJoin('membership', 'membership.id', '=', 'requests.membership_id')
                        ->leftJoin('admins', 'admins.id', '=', 'requests.admin_id')
                        ->select('requests.*', 'membership.id as membership_id', 'membership.type', 'admins.id as admin_id', 'admins.name')
                        ->where('role', 'admin')
                        ->orderBy('requests.id', 'DESC')
                        ->get();

        $dataReqUser = DB::table('requests')
                        ->leftJoin('membership', 'membership.id', '=', 'requests.membership_id')
                        ->select('requests.*', 'membership.id as membership_id', 'membership.type')
                        ->where('role', 'user')
                        ->orderBy('requests.id', 'DESC')
                        ->get();

        $dataBooking = DB::table('bookings')
                        ->leftJoin('users', 'users.id', '=', 'bookings.user_id')
                        ->leftJoin('membership', 'membership.id', '=', 'users.membership_id')
                        ->leftJoin('available_spaces', 'available_spaces.id', '=', 'bookings.available_id')
                        ->leftJoin('resorts', 'resorts.id', '=', 'available_spaces.resort_id')
                        ->leftJoin('destinations', 'destinations.id', '=', 'resorts.destination_id')
                        ->select('bookings.*', 'users.id as id_user', 'users.name as user',  'users.email', 'membership.id as membership_id', 'membership.type as membership', 'available_spaces.id as available_id', 'available_spaces.start_date', 'available_spaces.end_date', 'available_spaces.duration', 'resorts.id as resort_id', 'resorts.name as resort', 'resorts.price as total_price', 'destinations.id as destination_id', 'destinations.name as destination')
                        ->orderBy('bookings.id', 'DESC')
                        ->get();

        $dataGateways = DB::table('payment_gateways')->select('*')->get();

        if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('super-admin.dashboard', compact('totalAdmin', 'totalDestination', 'totalResort', 'notPaid', 'requestAdmin', 'requestUser', 'totalMember', 'dataReqAdmin', 'dataReqUser', 'dataBooking', 'dataGateways'));
    }

    public function Destinations()
    {
        $dataRegion = DB::table('regions')->select('*')->orderBy('regions.id', 'DESC')->get();

        $dataDestination = DB::table('destinations')->leftJoin('regions', 'regions.id', '=', 'destinations.region_id')->select('regions.id as region_id', 'regions.name as region', 'destinations.*')->orderBy('destinations.id', 'DESC')->get();

        if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('super-admin.destinations', compact('dataRegion', 'dataDestination'));
    }

    public function addRegion(Request $request)
    {
        DB::table('regions')->insert([
            'name' => $request->name,
            'created_at' => now(),
        ]);

        return redirect()->route('destinations-super-admin')->with('success', 'Successfully Added Region Data.');
    }

    public function editRegion(Request $request, $id)
    {
        DB::table('regions')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'updated_at' => now(),
            ]);

        return redirect()->route('destinations-super-admin')->with('success', 'Successfully Updated Region Data.');
    }

    public function deleteRegion(Request $request, $id)
    {
        DB::table('regions')->where('id', $id)->delete();

        return redirect()->route('destinations-super-admin')->with('success', 'Successfully Deleted Region Data.');
    }

    public function AddDestination(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1000',
        ]);

        $filename = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/destinations'), $filename);
        }

        DB::table('destinations')->insert([
            'region_id' => $request->region_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $filename,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Successfully Added Destination Data.');
    }

    public function EditDestination(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:1000',
        ]);

        $destination = DB::table('destinations')->where('id', $id)->first();

        if (!$destination) {
            return back()->with('error', 'Destination not found.');
        }

        $filename = $destination->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/destinations'), $filename);

            $oldPath = public_path('assets/destinations/' . $destination->image);
            if ($destination->image && File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $updateData = [
            'region_id' => $request->region_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $filename,
            'updated_at' => now(),
        ];

        DB::table('destinations')->where('id', $id)->update($updateData);

        return back()->with('success', 'Successfully Updated Destination Data.');
    }

    public function DeleteDestination($id)
    {
        $destination = DB::table('destinations')->where('id', $id)->first();

        if ($destination) {
            $filePath = public_path('assets/destinations/' . $destination->image);
            if ($destination->image && file_exists($filePath)) {
                unlink($filePath);
            }

            DB::table('destinations')->where('id', $id)->delete();
            return back()->with('success', 'Successfully Deleted Destination Data.');
        }

        return response()->json(['message' => 'Not found'], 404);
    }

    // Resorts
    public function Resorts()
    {
        $dataDestination = DB::table('destinations')->select('*')->orderBy('destinations.id', 'DESC')->get();

        $dataResorts = DB::table('resorts')->leftJoin('destinations', 'destinations.id', '=', 'resorts.destination_id')->select('destinations.id as destination_id', 'destinations.name as destination', 'resorts.*')->orderBy('resorts.id', 'DESC')->get();

        if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('super-admin.resorts', compact('dataResorts', 'dataDestination'));
    }

   public function AddResort(Request $request)
{
    $request->validate([
        'destination_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'facilities' => 'required|array',
        'facilities.*' => 'string|max:255',
        'images.*' => 'required|image|mimes:jpg,jpeg,png|max:1024',
    ]);

    // Logika Pembuatan Slug Unik
    $slug = Str::slug($request->name);
    $checkSlug = DB::table('resorts')->where('slug', $slug)->exists();
    if ($checkSlug) {
        $slug = $slug . '-' . Str::lower(Str::random(5));
    }

    $filenames = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/resorts'), $filename);
            $filenames[] = $filename;
        }
    }

    DB::table('resorts')->insert([
        'destination_id' => $request->destination_id,
        'name' => $request->name,
        'slug' => $slug, // Simpan slug ke database
        'location' => $request->location,
        'price' => $request->price,
        'description' => $request->description,
        'facilities' => json_encode($request->facilities),
        'images' => json_encode($filenames),
        'created_at' => now(),
    ]);

    return back()->with('success', 'Successfully Added Resort Data.');
}

public function EditResort(Request $request, $id)
{
    $request->validate([
        'destination_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'facilities' => 'required|array',
        'facilities.*' => 'string|max:255',
        'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
    ]);

    $resort = DB::table('resorts')->where('id', $id)->first();
    
    // Logika Update Slug Unik
    $slug = $resort->slug;
    if ($request->name !== $resort->name) {
        $newSlug = Str::slug($request->name);
        $checkSlug = DB::table('resorts')->where('slug', $newSlug)->where('id', '!=', $id)->exists();
        $slug = $checkSlug ? $newSlug . '-' . Str::lower(Str::random(5)) : $newSlug;
    }

    $filenames = json_decode($resort->images ?? '[]', true);

    if ($request->hasFile('images')) {
        // Delete old images
        foreach ($filenames as $image) {
            $imagePath = public_path('assets/resorts/' . $image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $filenames = [];
        foreach ($request->file('images') as $file) {
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/resorts'), $filename);
            $filenames[] = $filename;
        }
    }

    DB::table('resorts')
        ->where('id', $id)
        ->update([
            'destination_id' => $request->destination_id,
            'name' => $request->name,
            'slug' => $slug, // Update slug jika ada perubahan nama
            'location' => $request->location,
            'price' => $request->price,
            'description' => $request->description,
            'facilities' => json_encode($request->facilities),
            'images' => json_encode($filenames),
            'updated_at' => now(),
        ]);

    return back()->with('success', 'Successfully Updated Resort Data.');
}

    public function DeleteResort($id)
    {
        $resort = DB::table('resorts')->where('id', $id)->first();

        if ($resort) {
            // Delete images from storage
            $images = json_decode($resort->images, true) ?? [];
            foreach ($images as $image) {
                $imagePath = public_path('assets/resorts/' . $image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            DB::table('resorts')->where('id', $id)->delete();
            return back()->with('success', 'Successfully Deleted Resort Data.');
        }

        return back()->with('error', 'Resort not found.');
    }

    // Admins
    public function Admins()
    {
        $dataAdmins = DB::table('admins')->select('admins.*')->orderBy('admins.id', 'DESC')->get();

        if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('super-admin.admins', compact('dataAdmins'));
    }

    public function AddAdmin(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'division' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:admins,username',
                'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            ],
            [
                'username.unique' => 'Username already exists. Please choose a different username.',
                'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
                'password.min' => 'Password must be at least 8 characters long.',
            ],
        );

        DB::table('admins')->insert([
            'name' => $request->name,
            'division' => $request->division,
            'username' => $request->username,
            'password' => $request->password, // Jangan lupa encrypt password
            'created_at' => now(),
        ]);

        return back()->with('success', 'Successfully Added Admin Data.');
    }

    public function EditAdmin(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'division' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:admins,username,' . $id,
                'password' => ['nullable', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            ],
            [
                'username.unique' => 'Username already exists. Please choose a different username.',
                'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
                'password.min' => 'Password must be at least 8 characters long.',
            ],
        );

        $updateData = [
            'name' => $request->name,
            'division' => $request->division,
            'username' => $request->username,
            'updated_at' => now(),
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = $request->password;
        }

        DB::table('admins')->where('id', $id)->update($updateData);

        return back()->with('success', 'Successfully Updated Admin Data.');
    }

    public function DeleteAdmin($id)
    {
        // Prevent deleting yourself (optional)
        // if ($id == auth()->id()) {
        //     return back()->with('error', 'You cannot delete your own account.');
        // }

        DB::table('admins')->where('id', $id)->delete();

        return back()->with('success', 'Successfully Deleted Admin Data.');
    }

    // Users
    public function Users()
    {
        $dataMembership = DB::table('membership')->select('*')->orderBy('membership.id', 'DESC')->get();

        $dataMember = DB::table('users')
                        ->leftJoin('membership', 'membership.id', '=', 'users.membership_id')
                        ->select('users.*', 'membership.type as membership')
                        ->where('status', 'Paid')
                        ->orderBy('users.id', 'DESC')
                        ->get();

        $dataNotPaid = DB::table('users')
                        ->leftJoin('membership', 'membership.id', '=', 'users.membership_id')
                        ->select('users.*', 'membership.type as membership')
                        ->where('status', 'Not Paid')
                        ->orderBy('users.id', 'DESC')
                        ->get();

        if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('super-admin.users', compact('dataMember', 'dataNotPaid', 'dataMembership'));
    }

    public function EditNotPaid(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:admins,username,' . $id,
                'password' => ['nullable', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            ],
            [
                'username.unique' => 'Username already exists. Please choose a different username.',
                'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and   one special character.',
                'password.min' => 'Password must be at least 8 characters long.',
            ],
        );

        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'state' => $request->state,
                'membership_id' => $request->membership_id,
                'referral' => $request->referral,
                'status' => $request->status,
                'username' => $request->username,
                'password' => $request->password,
            ]);

        return back()->with('success', 'Successfully Updated User Data.');
    }

    public function DeleteNotPaid($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return back()->with('success', 'Successfully Deleted User Data.');
    }

    public function EditMember(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:admins,username,' . $id,
                'password' => ['nullable', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            ],
            [
                'username.unique' => 'Username already exists. Please choose a different username.',
                'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and   one special character.',
                'password.min' => 'Password must be at least 8 characters long.',
            ],
        );

        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'state' => $request->state,
                'membership_id' => $request->membership_id,
                'status' => $request->status,
                'referral' => $request->referral,
                'username' => $request->username,
                'password' => $request->password,
            ]);

        return back()->with('success', 'Successfully Updated Member Data.');
    }

    public function DeleteMember($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return back()->with('success', 'Successfully Deleted Member Data.');
    }

        // Membership
    public function manageMembership()
    {

         if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }

        $dataReservation = DB::table('reservations')
            ->select('reservations.*', 'users.name as user', 'users.email', 'resorts.name as resort', 'destinations.name as destination')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('resorts', 'reservations.resort_id', '=', 'resorts.id')
            ->join('destinations', 'resorts.destination_id', '=', 'destinations.id')
            ->get();

        $dataAvailable = DB::table('available_spaces')
            ->select('available_spaces.*', 'resorts.name as resort', 'destinations.name as destination', 'membership.type as membership')
            ->join('resorts', 'available_spaces.resort_id', '=', 'resorts.id')
            ->join('destinations', 'resorts.destination_id', '=', 'destinations.id')
            ->join('membership', 'available_spaces.membership_id', '=', 'membership.id')
            ->get();

        $dataResort = DB::table('resorts')->get();
        $dataDestination = DB::table('destinations')->get();
        $users = DB::table('users')->get();
        $memberships = DB::table('membership')->get();

        return view('super-admin.membership', compact(
            'dataReservation', 
            'dataAvailable', 
            'dataResort', 
            'dataDestination',
            'users',
            'memberships'
        ));
    }

    // Add Reservation
    public function addReservation(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'resort_id' => 'required|exists:resorts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        // Calculate duration in days
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $duration = $startDate->diffInDays($endDate);

        DB::table('reservations')->insert([
            'user_id' => $request->user_id,
            'resort_id' => $request->resort_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'duration' => $duration,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Reservation added successfully.');
    }

    // Edit Reservation
    public function editReservation(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'resort_id' => 'required|exists:resorts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        // Calculate duration in days
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $duration = $startDate->diffInDays($endDate);

        DB::table('reservations')
            ->where('id', $id)
            ->update([
                'user_id' => $request->user_id,
                'resort_id' => $request->resort_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'duration' => $duration,
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Reservation updated successfully.');
    }

    // Delete Reservation
    public function deleteReservation($id)
    {
        DB::table('reservations')->where('id', $id)->delete();
        return back()->with('success', 'Reservation deleted successfully.');
    }

    // Add Available Space (SINGLE RECORD dengan range tanggal)
    public function addAvailableSpace(Request $request)
    {
        $request->validate([
            'resort_id' => 'required|exists:resorts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'capacity' => 'required|integer|min:1',
            'membership_id' => 'required|exists:membership,id'
        ]);

        // Hitung durasi dalam hari
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $duration = $startDate->diffInDays($endDate);

        DB::table('available_spaces')->insert([
            'resort_id' => $request->resort_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'duration' => $duration,
            'capacity' => $request->capacity,
            'membership_id' => $request->membership_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Available space added successfully for the selected date range.');
    }

    // Edit Available Space
    public function editAvailableSpace(Request $request, $id)
    {
        $request->validate([
            'resort_id' => 'required|exists:resorts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'capacity' => 'required|integer|min:1',
            'membership_id' => 'required|exists:membership,id'
        ]);

        // Hitung durasi dalam hari
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $duration = $startDate->diffInDays($endDate);

        DB::table('available_spaces')
            ->where('id', $id)
            ->update([
                'resort_id' => $request->resort_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'duration' => $duration,
                'capacity' => $request->capacity,
                'membership_id' => $request->membership_id,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Available space updated successfully.');
    }

    // Delete Available Space
    public function deleteAvailableSpace($id)
    {
        DB::table('available_spaces')->where('id', $id)->delete();
        return back()->with('success', 'Available space deleted successfully.');
    }


    public function Report()
    {
         if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }

        $dataReport = DB::table('admin_reports')
                    ->leftJoin('admins', 'admins.id', 'admin_reports.admin_id')
                    ->select('admin_reports.*', 'admins.name', 'admins.username', 'admins.password')
                    ->orderBy('admin_reports.id', 'DESC')
                    ->get();

        $dataRegistration = DB::table('registrations')
        ->join('users', 'registrations.user_id', '=', 'users.id')
        ->join('membership', 'users.membership_id', '=', 'membership.id')
        ->select(
            'registrations.*',
            'users.name',
            'users.email', 
            'users.phone',
            'users.state',
            'membership.type',
            'users.status as user_status'
        )
        ->orderBy('registrations.created_at', 'desc')
        ->get();



                    return view('super-admin.reports', compact('dataReport', 'dataRegistration'));
    }


    public function deleteAdminReport($id)
    {
        DB::table('admin_reports')->where('id', $id)->delete();

        return back()->with('success', 'Admin Report Deleted Successfully.');
    }

    // Di SuperAdminController
public function approveRegistration(Request $request)
{
    DB::beginTransaction();
    
    try {
        $validator = Validator::make($request->all(), [
            'registration_id' => 'required|exists:registrations,id',
            'user_email' => 'required|email',
            'user_name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . $validator->errors()->first()
            ], 400);
        }

        $registration = DB::table('registrations')->where('id', $request->registration_id)->first();
        
        // Update registration status to success
        DB::table('registrations')
            ->where('id', $request->registration_id)
            ->update([
                'status' => 'success',
                'updated_at' => now()
            ]);

        // Update user status to Paid and generate referral
        DB::table('users')
            ->where('id', $registration->user_id)
            ->update([
                'status' => 'Paid',
                'referral' => $this->generateReferralCode(),
                'updated_at' => now()
            ]);

        // Update referral_used if exists
        DB::table('referral_used')
            ->where('user_id', $registration->user_id)
            ->where('status', 'Not Paid')
            ->update([
                'status' => 'Paid',
                'updated_at' => now()
            ]);

        // Send email notification
        $this->sendPaymentApprovalEmail($request->user_email, $request->user_name);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Payment approved successfully'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Approve registration error: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Approval failed: ' . $e->getMessage()
        ], 500);
    }
}

public function deleteRegistration($id)
{
    DB::beginTransaction();
    
    try {
        $registration = DB::table('registrations')->where('id', $id)->first();
        
        if (!$registration) {
            return back()->with('error', 'Registration not found.');
        }

        // Get user email for notification
        $user = DB::table('users')->where('id', $registration->user_id)->first();
        
        // Delete registration
        DB::table('registrations')->where('id', $id)->delete();

        // Send rejection email
        if ($user) {
            $this->sendPaymentRejectionEmail($user->email, $user->name);
        }

        DB::commit();

        return back()->with('success', 'Registration deleted successfully. Rejection email sent to user.');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Delete registration error: ' . $e->getMessage());
        
        return back()->with('error', 'Failed to delete registration: ' . $e->getMessage());
    }
}

// Di dalam SuperAdminController
private function sendPaymentApprovalEmail($email, $name)
{
    try {
        Mail::to($email)->send(new PaymentApproved($name));
        Log::info("Approval email sent to: {$email}");
    } catch (\Exception $e) {
        Log::error("Failed to send approval email: " . $e->getMessage());
    }
}

private function sendPaymentRejectionEmail($email, $name)
{
    try {
        Mail::to($email)->send(new PaymentRejected($name));
        Log::info("Rejection email sent to: {$email}");
    } catch (\Exception $e) {
        Log::error("Failed to send rejection email: " . $e->getMessage());
    }
}

// Generate referral code (copy from PaymentController)
private function generateReferralCode()
{
    do {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        for ($i = 0; $i < 8; $i++) {
            $code .= $characters[rand(0, 35)];
        }
        $exists = DB::table('users')->where('referral', $code)->exists();
    } while ($exists);

    return $code;
}


    // Contents
    public function Content()
    {
        $dataNews = DB::table('news')->select('news.*')->orderBy('news.id', 'DESC')->get();

        $dataPlans = DB::table('membership')->select('membership.*')->orderBy('membership.id', 'DESC')->get();

        return view('super-admin.contents', compact('dataNews', 'dataPlans'));
    }

   // ==================== NEWS CRUD ====================
    public function addNews(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'source' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/news'), $filename);
        }

        DB::table('news')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'source' => $request->source,
            'image' => $filename,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'News added successfully.');
    }

    public function editNews(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'source' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $news = DB::table('news')->where('id', $id)->first();
        $filename = $news->image;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($news->image && file_exists(public_path('assets/news/' . $news->image))) {
                unlink(public_path('assets/news/' . $news->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/news'), $filename);
        }

        DB::table('news')
            ->where('id', $id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'source' => $request->source,
                'image' => $filename,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'News updated successfully.');
    }

    public function deleteNews($id)
    {
        $news = DB::table('news')->where('id', $id)->first();
        
        // Delete image file
        if ($news->image && file_exists(public_path('assets/news/' . $news->image))) {
            unlink(public_path('assets/news/' . $news->image));
        }

        DB::table('news')->where('id', $id)->delete();
        return back()->with('success', 'News deleted successfully.');
    }

    // ==================== PLANS CRUD ====================

    public function addPlan(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'features' => 'required|array',
            'features.*' => 'string|max:255',
            'contract' => 'required|string|max:100', // e.g., "12 months", "1 year", "Lifetime"
        ]);

        // Logika Pembuatan Slug Unik
        $slug = Str::slug($request->type);
        $checkSlug = DB::table('membership')->where('slug', $slug)->exists();
        if ($checkSlug) {
            $slug = $slug . '-' . Str::lower(Str::random(5));
        }

        DB::table('membership')->insert([
            'type' => $request->type,
            'slug' => $slug,
            'price' => $request->price,
            'features' => json_encode($request->features),
            'contract' => $request->contract,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Plan added successfully.');
    }

    public function editPlan(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'features' => 'required|array',
            'features.*' => 'string|max:255',
            'contract' => 'required|string|max:100',
        ]);

            $membership = DB::table('membership')->where('id', $id)->first();
    
    // Logika Update Slug Unik
    $slug = $membership->slug;
    if ($request->type !== $membership->type) {
        $newSlug = Str::slug($request->type);
        $checkSlug = DB::table('membership')->where('slug', $newSlug)->where('id', '!=', $id)->exists();
        $slug = $checkSlug ? $newSlug . '-' . Str::lower(Str::random(5)) : $newSlug;
    }

        DB::table('membership')
            ->where('id', $id)
            ->update([
                'type' => $request->type,
                'slug' => $slug,
                'price' => $request->price,
                'features' => json_encode($request->features),
                'contract' => $request->contract,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Plan updated successfully.');
    }

    public function deletePlan($id)
    {
        DB::table('membership')->where('id', $id)->delete();
        return back()->with('success', 'Plan deleted successfully.');
    }
    



     // ==================== BOOKING ACTIONS - TETAP SAMA ====================
public function acceptBooking($id)
{
    try {
        // Ambil data booking
        $booking = DB::table('bookings')
            ->where('id', $id)
            ->first();

        if (!$booking) {
            return back()->with('error', 'Booking not found.');
        }

        // Ambil data available_space untuk mendapatkan resort_id dan tanggal
        $availableSpace = DB::table('available_spaces')
            ->where('id', $booking->available_id)
            ->first();

        if (!$availableSpace) {
            return back()->with('error', 'Available space not found.');
        }

        // Update status booking
        DB::table('bookings')
            ->where('id', $id)
            ->update([
                'status' => 'confirmed',
                'updated_at' => now(),
            ]);

        // Insert ke tabel reservations
        $reservationId = DB::table('reservations')->insertGetId([
            'user_id' => $booking->user_id,
            'resort_id' => $availableSpace->resort_id,
            'start_date' => $availableSpace->start_date,
            'end_date' => $availableSpace->end_date,
            'duration' => $booking->stay_duration,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Optional: Update available_space status jika perlu
        // DB::table('available_spaces')
        //     ->where('id', $booking->available_id)
        //     ->update([
        //         'status' => 'booked',
        //         'updated_at' => now()
        //     ]);

        Log::info('Booking accepted and reservation created', [
            'booking_id' => $id,
            'reservation_id' => $reservationId,
            'user_id' => $booking->user_id,
            'resort_id' => $availableSpace->resort_id
        ]);

        return back()->with('success', 'Booking accepted and reservation created successfully.');

    } catch (\Exception $e) {
        Log::error('Error accepting booking: ' . $e->getMessage());
        return back()->with('error', 'Failed to accept booking: ' . $e->getMessage());
    }
}

    public function rejectBooking($id)
    {
        DB::table('bookings')
            ->where('id', $id)
            ->update([
                'status' => 'rejected',
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Booking rejected.');
    }

    public function confirmPayment($id)
    {
        DB::table('bookings')
            ->where('id', $id)
            ->update([
                'status' => 'paid',
                'payment_status' => 'paid',
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Payment confirmed successfully.');
    }

    // ==================== USER REQUEST ACTIONS - DIUBAH ====================
    // HAPUS METHOD createUserModal() karena modal sudah inline

public function createUser(Request $request, $id)
{
    $reqData = DB::table('requests')->where('id', $id)->first();

    // Validasi
    $request->validate([
        'username' => 'required|string|unique:users,username',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'password.min' => 'Password must be at least 8 characters long.',
        'username.unique' => 'Username already exists.',
        'password.confirmed' => 'Password confirmation does not match.'
    ]);

    // Cek jika user dengan email yang sama sudah ada
    $existingUser = DB::table('users')->where('email', $reqData->email)->first();
    if ($existingUser) {
        return back()->with('error', 'User with this email already exists.');
    }

    // Create user TANPA referral code dulu
    $userId = DB::table('users')->insertGetId([
        'name' => $reqData->user,
        'username' => $request->username,
        'email' => $reqData->email,
        'phone' => $reqData->phone,
        'state' => $reqData->state,
        'membership_id' => $reqData->membership_id,
        'referral' => null, // NULL dulu, nanti dibuat setelah bayar
        'password' => $request->password,
        'status' => 'Not Paid', 
        'payment_expiry_at' => now()->addDays(1),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Jika user menggunakan referral code saat request
    if ($reqData->referral) {
        // Cari user yang punya referral code tersebut
        $referralOwner = DB::table('users')->where('referral', $reqData->referral)->first();
        
        if ($referralOwner) {
            // Insert ke tabel referral_used
            DB::table('referral_used')->insert([
                'user_id' => $userId, // user yang pakai referral
                'referral' => $reqData->referral, // kode yang dipakai
                'referral_owner_id' => $referralOwner->id, // user pemilik kode
                'status' => 'Not Paid', // akan berubah jadi Paid ketika user bayar
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            Log::info("Referral used: User {$userId} used referral code {$reqData->referral} from user {$referralOwner->id}");
        } else {
            Log::warning("Referral code not found: {$reqData->referral} used by user {$userId}");
        }
    }

    // Kirim email ke user menggunakan Mailable
    try {
        $userData = [
            'name' => $reqData->user,
            'username' => $request->username,
            'email' => $reqData->email,
            'password' => $request->password,
            'used_referral' => $reqData->referral, // info referral yang dipakai
            // TIDAK kirim referral_code karena belum dibuat
        ];

        Mail::to($reqData->email)->send(new UserAccountCreated($userData));

        Log::info("Email sent successfully to: {$reqData->email}");

    } catch (\Exception $e) {
        Log::error('Failed to send email to user: ' . $e->getMessage());
    }

    // Hapus request
    DB::table('requests')->where('id', $id)->delete();

    return back()->with('success', 'User account created successfully and email notification sent.');
}

/**
 * Generate unique referral code
 */
private function generateUniqueReferralCode($length = 8)
{
    do {
        // Kombinasi huruf dan angka
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        // Cek jika code sudah ada di database
        $existing = DB::table('users')->where('referral', $code)->exists();
        
    } while ($existing); // Ulangi jika code sudah ada
    
    return $code;
}

    public function deleteUserRequest($id)
    {
        DB::table('requests')->where('id', $id)->delete();
        return back()->with('success', 'User request deleted.');
    }

    // ==================== ADMIN REQUEST ACTIONS - DIUBAH ====================
    // HAPUS METHOD editAdminModal() karena modal sudah inline

    public function updateAdminRequest(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ], [
            'password.min' => 'Password must be at least 8 characters long.'
        ]);

        // Cek jika username sudah ada di admin
        $existingAdmin = DB::table('users')->where('username', $request->username)->first();
        if ($existingAdmin) {
            return back()->with('error', 'Username already exists. Please choose a different username.');
        }

        DB::table('requests')
            ->where('id', $id)
            ->update([
                'username' => $request->username,
                'password' => $request->password,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Admin request updated successfully.');
    }

    public function approveAdmin($id)
    {
        $reqData = DB::table('requests')->where('id', $id)->first();

        if (!$reqData) {
            return back()->with('error', 'Request not found.');
        }

        // Cek jika admin dengan username yang sama sudah ada
        $existingAdmin = DB::table('users')->where('username', $reqData->username)->first();
        if ($existingAdmin) {
            return back()->with('error', 'User with this username already exists.');
        }

        // Cek jika admin dengan email yang sama sudah ada
        $existingEmail = DB::table('users')->where('email', $reqData->email)->first();
        if ($existingEmail) {
            return back()->with('error', 'User with this email already exists.');
        }

        // Create admin account
        DB::table('users')->insert([
            'name' => $reqData->user,
            'email' => $reqData->email,
            'phone' => $reqData->phone,
            'state' => $reqData->state,
            'username' => $reqData->username,
            'password' => $reqData->password, // Store as plain text
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Update request status
        DB::table('requests')
            ->where('id', $id)
            ->update([
                'status' => 'approved',
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Admin account created successfully.');
    }

    public function disapproveAdmin($id)
    {
        DB::table('requests')
            ->where('id', $id)
            ->update([
                'status' => 'disapproved',
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Admin request disapproved.');
    }

    public function approveAllAdmins()
    {
        $pendingAdmins = DB::table('requests')
            ->where('role', 'admin')
            ->where('status', 'pending')
            ->get();

        $createdCount = 0;
        $errorCount = 0;

        foreach ($pendingAdmins as $admin) {
            // Cek duplikasi
            $existingAdmin = DB::table('users')->where('username', $admin->username)->first();
            $existingEmail = DB::table('users')->where('email', $admin->email)->first();

            if ($existingAdmin || $existingEmail) {
                $errorCount++;
                continue;
            }

            // Create admin account
            DB::table('users')->insert([
                'name' => $admin->user,
                'email' => $admin->email,
                'phone' => $admin->phone,
                'state' => $admin->state,
                'username' => $admin->username,
                'password' => $admin->password,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('requests')
                ->where('id', $admin->id)
                ->update([
                    'status' => 'approved',
                    'updated_at' => now(),
                ]);

            $createdCount++;
        }

        $message = "{$createdCount} admin accounts created successfully.";
        if ($errorCount > 0) {
            $message .= " {$errorCount} requests skipped due to duplicate username/email.";
        }

        return back()->with('success', $message);
    }

    // ==================== UTILITY FUNCTIONS - TETAP SAMA ====================
    private function generateStrongPassword($length = 12)
    {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?';

        $password = '';
        $password .= $uppercase[rand(0, strlen($uppercase) - 1)];
        $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
        $password .= $numbers[rand(0, strlen($numbers) - 1)];
        $password .= $symbols[rand(0, strlen($symbols) - 1)];

        $allCharacters = $uppercase . $lowercase . $numbers . $symbols;
        for ($i = 4; $i < $length; $i++) {
            $password .= $allCharacters[rand(0, strlen($allCharacters) - 1)];
        }

        return str_shuffle($password);
    }
}
