@extends('layouts.super-admin')

@section('title', 'Manage Users - Super Admin')

@section('content')
    <main class="mt-[20px] space-y-[40px]">

        {{-- Tabel 1: Users --}}
            <div class="bg-white border shadow-md p-6">
                <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
                    <h2 class="text-xl font-semibold">User Data</h2>

                    {{-- <button class="px-8 py-3 text-white bg-green-800 font-bold">
                        Export Data
                    </button> --}}
                </div>
                <div class="overflow-x-auto">
                    <table id="users-admin" class="min-w-full text-left text-sm">
                        <thead class="text-white bg-dark">
                            <tr>
                                <th class="py-3 px-4">No</th>
                                <th class="py-3 px-4">Name</th>
                                <th class="py-3 px-4">Email</th>
                                <th class="py-3 px-4">Phone</th>
                                <th class="py-3 px-4">Membership</th>
                                <th class="py-3 px-4">State</th>
                                <th class="py-3 px-4">Username</th>
                                <th class="py-3 px-4">Password</th>
                                <th class="py-3 px-4">Joined</th>
                                <th class="py-3 px-4">Contract</th>
                                <th class="py-3 px-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataMember as $dm)
                                <tr>
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $dm->name }}</td>
                                <td class="py-3 px-4">{{ $dm->email }}</td>
                                <td class="py-3 px-4">{{ $dm->phone }}</td>
                                <td class="py-3 px-4">{{ $dm->membership }}</td>
                                <td class="py-3 px-4">{{ $dm->state }}</td>
                                <td class="py-3 px-4">{{ $dm->username }}</td>
                                <td class="py-3 px-4">{{ $dm->password }}</td>
                                <td class="py-3 px-4">{{ $dm->created_at }}</td>
                                <td class="py-3 px-4">1 Year</td>
                                 <td class="py-3 px-4 flex items-center gap-3">
                                    <button class="p-2 bg-blue-800 text-white font-medium"
                                        data-modal-target="editMemberModal{{ $dm->id }}"
                                        data-modal-toggle="editMemberModal{{ $dm->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('delete-member', $dm->id) }}" method="POST"
                                        onsubmit="return confirmDelete(event)">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="p-2 bg-red-800 text-white font-medium">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabel 1: Not Paid --}}
<div class="bg-white border shadow-md p-6">
    <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
        <h2 class="text-xl font-semibold">Unpaid User</h2>
    </div>
    <div class="overflow-x-auto">
        <table id="not-paid-admin" class="min-w-full text-left text-sm">
            <thead class="text-white bg-dark">
                <tr>
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Phone</th>
                    <th class="py-3 px-4">Membership</th>
                    <th class="py-3 px-4">State</th>
                    <th class="py-3 px-4">Username</th>
                    <th class="py-3 px-4">Password</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Date</th>
                    <th class="py-3 px-4">Expired</th>
                    <th class="py-3 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataNotPaid as $dnp)
                    @php
                        $isExpired = $dnp->payment_expiry_at && \Carbon\Carbon::parse($dnp->payment_expiry_at) < now();
                        $rowClass = $isExpired ? 'bg-red-50 border-l-4 border-red-500' : 'bg-yellow-50 border-l-4 border-yellow-500';
                    @endphp
                    <tr class="{{ $rowClass }} hover:bg-gray-100 transition-colors">
                        <td class="py-3 px-4 font-medium">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 font-medium">{{ $dnp->name }}</td>
                        <td class="py-3 px-4">{{ $dnp->email }}</td>
                        <td class="py-3 px-4">{{ $dnp->phone }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $dnp->membership }}
                            </span>
                        </td>
                        <td class="py-3 px-4">{{ $dnp->state }}</td>
                        <td class="py-3 px-4 font-mono text-sm">{{ $dnp->username }}</td>
                        <td class="py-3 px-4 font-mono text-sm">{{ $dnp->password }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded text-xs font-medium 
                                @if($isExpired) bg-red-100 text-red-800 border border-red-300
                                @else bg-yellow-100 text-yellow-800 border border-yellow-300 @endif">
                                {{ $dnp->status }}
                                @if($isExpired) ⚠️ EXPIRED @endif
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-600 text-sm">
                            {{ \Carbon\Carbon::parse($dnp->created_at)->format('M d, Y H:i') }}
                        </td>
                        <td class="py-3 px-4">
                            <span class="text-sm @if($isExpired) text-red-600 font-bold @else text-orange-600 @endif">
                                {{ \Carbon\Carbon::parse($dnp->payment_expiry_at)->format('M d, Y H:i') }}
                                @if($isExpired)
                                    <br><span class="text-xs text-red-500">(Expired)</span>
                                @else
                                    <br><span class="text-xs text-orange-500">
                                        (in {{ \Carbon\Carbon::parse($dnp->payment_expiry_at)->diffForHumans() }})
                                    </span>
                                @endif
                            </span>
                        </td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <button class="p-2 bg-blue-800 text-white font-medium  hover:bg-blue-900 transition-colors"
                                data-modal-target="editNotPaidModal{{ $dnp->id }}"
                                data-modal-toggle="editNotPaidModal{{ $dnp->id }}">
                                Edit
                            </button>
                              <form action="{{ route('delete-not-paid', $dnp->id) }}" method="POST"
                                        onsubmit="return confirmDelete(event)">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="p-2 bg-red-800 text-white font-medium">Delete</button>
                                    </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    </main>

        {{-- ==================== MODAL EDIT MEMBER NOT PAID (UNTUK SETIAP DATA) ==================== --}}
@foreach ($dataMember as $dm)
<div id="editMemberModal{{ $dm->id }}" class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50">
    <div class="bg-white w-[90%] h-[90%]  p-6 rounded-lg shadow-lg mx-auto">
        <h3 class="text-lg font-semibold mb-8 pb-5 border-b-2">Edit Member</h3>
        <form action="{{ route('edit-member', $dm->id) }}" method="POST" class="grid grid-cols-3 gap-5">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-medium">Name</label>
                <input type="text" name="name" value="{{ $dm->name }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Email</label>
                <input type="text" name="email" value="{{ $dm->email }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Phone</label>
                <input type="text" name="phone" value="{{ $dm->phone }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">State</label>
                <input type="text" name="state" value="{{ $dm->state }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Referral</label>
                <input type="text" name="referral" value="{{ $dm->referral }}" class="w-full border px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Status</label>
                <input type="text" name="status" value="{{ $dm->status }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Membership</label>
                <select name="membership_id" class="w-full border px-3 py-2" required>
                    <option value="">-- Select Membership --</option>
                    @foreach ($dataMembership as $dms)
                        <option value="{{ $dms->id }}" {{ $dms->id == $dm->membership_id ? 'selected' : '' }}>
                            {{ $dms->type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Username</label>
                <input type="text" name="username" value="{{ $dm->username }}" class="w-full border px-3 py-2" required>
                @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Password</label>
                <input type="text" name="password" value="{{ $dm->password }}" class="w-full border px-3 py-2" required>
                 @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="flex justify-end gap-3 col-span-3">
                <button type="button" data-modal-hide="editMemberModal{{ $dm->id }}" class="px-4 py-2 border">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-700 text-white">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach

    {{-- ==================== MODAL EDIT USER NOT PAID (UNTUK SETIAP DATA) ==================== --}}
@foreach ($dataNotPaid as $dnpd)
<div id="editNotPaidModal{{ $dnpd->id }}" class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50">
    <div class="bg-white w-[90%] h-[90%]  p-6 rounded-lg shadow-lg mx-auto">
        <h3 class="text-lg font-semibold mb-8 pb-5 border-b-2">Edit Not-Paid User</h3>
        <form action="{{ route('edit-not-paid', $dnpd->id) }}" method="POST" class="grid grid-cols-3 gap-5">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-medium">Name</label>
                <input type="text" name="name" value="{{ $dnpd->name }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Email</label>
                <input type="text" name="email" value="{{ $dnpd->email }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Phone</label>
                <input type="text" name="phone" value="{{ $dnpd->phone }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">State</label>
                <input type="text" name="state" value="{{ $dnpd->state }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Referral</label>
                <input type="text" name="referral" value="{{ $dnpd->referral }}" class="w-full border px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Status</label>
                <input type="text" name="status" value="{{ $dnpd->status }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Membership</label>
                <select name="membership_id" class="w-full border px-3 py-2" required>
                    <option value="">-- Select Membership --</option>
                    @foreach ($dataMembership as $dms)
                        <option value="{{ $dms->id }}" {{ $dms->id == $dnpd->membership_id ? 'selected' : '' }}>
                            {{ $dms->type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Username</label>
                <input type="text" name="username" value="{{ $dnpd->username }}" class="w-full border px-3 py-2" required>
                @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Password</label>
                <input type="text" name="password" value="{{ $dnpd->password }}" class="w-full border px-3 py-2" required>
                 @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="flex justify-end gap-3 col-span-3">
                <button type="button" data-modal-hide="editNotPaidModal{{ $dnpd->id }}" class="px-4 py-2 border">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-700 text-white">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection

