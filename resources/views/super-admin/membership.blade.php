@extends('layouts.super-admin')

@section('title', 'Manage Membership - Super Admin')

@section('content')
    <main class="mt-[20px] space-y-[40px]">

        {{-- Tabel 1: Reservation --}}
        <div class="bg-white border shadow-md p-6">
            <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
                <h2 class="text-xl font-semibold">Reservation Data</h2>
                <div class="flex gap-3">
                    {{-- <button class="px-6 py-3 text-white bg-blue-600 font-bold">
                        Export Data
                    </button> --}}
                    <button class="px-6 py-3 text-white bg-green-800 font-bold"
                            onclick="openModal('addReservationModal')">
                        Add Reservation
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="membership-admin" class="min-w-full text-left text-sm">
                    <thead class="text-white bg-dark">
                        <tr>
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Name</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4">Destination</th>
                            <th class="py-3 px-4">Resort</th>
                            <th class="py-3 px-4">Start Date</th>
                            <th class="py-3 px-4">End Date</th>
                            <th class="py-3 px-4">Duration</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataReservation as $drv)
                            <tr>
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $drv->user }}</td>
                                <td class="py-3 px-4">{{ $drv->email }}</td>
                                <td class="py-3 px-4">{{ $drv->destination }}</td>
                                <td class="py-3 px-4">{{ $drv->resort }}</td>
                                <td class="py-3 px-4">{{ \Carbon\Carbon::parse($drv->start_date)->format('M d, Y') }}</td>
                                <td class="py-3 px-4">{{ \Carbon\Carbon::parse($drv->end_date)->format('M d, Y') }}</td>
                                <td class="py-3 px-4">{{ $drv->duration }} days</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 rounded text-xs font-medium 
                                        @if($drv->status == 'confirmed') bg-green-100 text-green-800
                                        @elseif($drv->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($drv->status == 'cancelled') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($drv->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 flex items-center gap-3">
                                    <button class="p-2 bg-blue-800 text-white font-medium text-sm"
                                        onclick="openModal('editReservationModal{{ $drv->id }}')">
                                        Edit
                                    </button>
                                    <form action="{{ route('delete-reservation', $drv->id) }}" method="POST"
                                        onsubmit="return confirmDelete(event)">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="p-2 bg-red-800 text-white font-medium text-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabel 2: Available Space --}}
        <div class="bg-white border shadow-md p-6">
            <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
                <h2 class="text-xl font-semibold">Available Space</h2>
                <button class="px-6 py-3 text-white bg-green-800 font-bold"
                        onclick="openModal('addAvailableSpaceModal')">
                    Add Data
                </button>
            </div>
            <div class="overflow-x-auto">
                <table id="available-space-admin" class="min-w-full text-left text-sm">
                    <thead class="text-white bg-dark">
                        <tr>
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Destination</th>
                            <th class="py-3 px-4">Resort</th>
                            <th class="py-3 px-4">Start Date</th>
                            <th class="py-3 px-4">End Date</th>
                            <th class="py-3 px-4">Duration</th>
                            <th class="py-3 px-4">Capacity</th>
                            <th class="py-3 px-4">Membership</th>
                            <th class="py-3 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataAvailable as $dav)
                            <tr>
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $dav->destination }}</td>
                                <td class="py-3 px-4">{{ $dav->resort }}</td>
                                <td class="py-3 px-4">{{ \Carbon\Carbon::parse($dav->start_date)->format('M d, Y') }}</td>
                                <td class="py-3 px-4">{{ \Carbon\Carbon::parse($dav->end_date)->format('M d, Y') }}</td>
                                <td class="py-3 px-4">{{ $dav->duration }} days</td>
                                <td class="py-3 px-4">{{ $dav->capacity }} persons</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 rounded text-xs font-medium 
                                        @if($dav->membership == 'Silver') bg-purple-100 text-purple-800
                                        @elseif($dav->membership == 'Gold') bg-yellow-100 text-yellow-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ $dav->membership }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 flex items-center gap-3">
                                    <button class="p-2 bg-blue-800 text-white font-medium text-sm"
                                        onclick="openModal('editAvailableSpaceModal{{ $dav->id }}')">
                                        Edit
                                    </button>
                                    <form action="{{ route('delete-available-space', $dav->id) }}" method="POST"
                                        onsubmit="return confirmDelete(event)">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="p-2 bg-red-800 text-white font-medium text-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- ==================== MODAL ADD RESERVATION ==================== --}}
    <div id="addReservationModal" class="fixed inset-0 bg-black/60 z-50 items-center justify-center hidden">
        <div class="bg-white w-[70%] rounded-lg shadow-lg max-h-[90vh] overflow-y-auto mx-auto mt-10">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Add New Reservation</h3>
                <form action="{{ route('add-reservation') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">User</label>
                            <select name="user_id" class="w-full border px-3 py-2" required>
                                <option value="">-- Select User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">Resort</label>
                            <select name="resort_id" class="w-full border px-3 py-2" required>
                                <option value="">-- Select Resort --</option>
                                @foreach ($dataResort as $resort)
                                    <option value="{{ $resort->id }}">{{ $resort->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">Start Date</label>
                            <input type="date" name="start_date" class="w-full border px-3 py-2 datepicker" required>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">End Date</label>
                            <input type="date" name="end_date" class="w-full border px-3 py-2 datepicker" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Status</label>
                        <select name="status" class="w-full border px-3 py-2" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('addReservationModal')" class="px-4 py-2 border">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-700 text-white">Add Reservation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL EDIT RESERVATION ==================== --}}
    @foreach ($dataReservation as $drv)
    <div id="editReservationModal{{ $drv->id }}" class="fixed inset-0 bg-black/60 z-50 items-center justify-center hidden">
        <div class="bg-white w-[70%] rounded-lg shadow-lg mx-auto max-h-[90vh] overflow-y-auto mt-10">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Edit Reservation</h3>
                <form action="{{ route('edit-reservation', $drv->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">User</label>
                            <select name="user_id" class="w-full border px-3 py-2" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $drv->user_id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">Resort</label>
                            <select name="resort_id" class="w-full border px-3 py-2" required>
                                @foreach ($dataResort as $resort)
                                    <option value="{{ $resort->id }}" {{ $resort->id == $drv->resort_id ? 'selected' : '' }}>
                                        {{ $resort->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">Start Date</label>
                            <input type="date" name="start_date" value="{{ $drv->start_date }}" class="w-full border px-3 py-2 datepicker" required>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">End Date</label>
                            <input type="date" name="end_date" value="{{ $drv->end_date }}" class="w-full border px-3 py-2 datepicker" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Status</label>
                        <select name="status" class="w-full border px-3 py-2" required>
                            <option value="pending" {{ $drv->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $drv->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $drv->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="completed" {{ $drv->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('editReservationModal{{ $drv->id }}')" class="px-4 py-2 border">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-700 text-white">Update Reservation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

        {{-- ==================== MODAL ADD AVAILABLE SPACE ==================== --}}
    <div id="addAvailableSpaceModal" class="fixed inset-0 bg-black/60 z-50 items-center justify-center hidden">
        <div class="bg-white w-[70%] rounded-lg shadow-lg mx-auto mt-10">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Add Available Space</h3>
                <form action="{{ route('add-available-space') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Resort</label>
                        <select name="resort_id" class="w-full border px-3 py-2" required>
                            <option value="">-- Select Resort --</option>
                            @foreach ($dataResort as $resort)
                                <option value="{{ $resort->id }}">{{ $resort->name }} - {{ $resort->location }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">Start Date</label>
                            <input type="date" name="start_date" class="w-full border px-3 py-2 datepicker" required>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">End Date</label>
                            <input type="date" name="end_date" class="w-full border px-3 py-2 datepicker" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Capacity (Persons)</label>
                        <input type="number" name="capacity" class="w-full border px-3 py-2" min="1" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Membership Type</label>
                        <select name="membership_id" class="w-full border px-3 py-2" required>
                            <option value="">-- Select Membership --</option>
                            @foreach ($memberships as $membership)
                                <option value="{{ $membership->id }}">{{ $membership->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('addAvailableSpaceModal')" class="px-4 py-2 border">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-700 text-white">Add Space</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL EDIT AVAILABLE SPACE ==================== --}}
    @foreach ($dataAvailable as $dav)
    <div id="editAvailableSpaceModal{{ $dav->id }}" class="fixed inset-0 bg-black/60 z-50 items-center justify-center hidden">
        <div class="bg-white w-[70%] rounded-lg shadow-lg mx-auto mt-10">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Edit Available Space</h3>
                <form action="{{ route('edit-available-space', $dav->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Resort</label>
                        <select name="resort_id" class="w-full border px-3 py-2" required>
                            @foreach ($dataResort as $resort)
                                <option value="{{ $resort->id }}" {{ $resort->id == $dav->resort_id ? 'selected' : '' }}>
                                    {{ $resort->name }} - {{ $resort->location }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">Start Date</label>
                            <input type="date" name="start_date" value="{{ $dav->start_date }}" class="w-full border px-3 py-2 datepicker" required>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">End Date</label>
                            <input type="date" name="end_date" value="{{ $dav->end_date }}" class="w-full border px-3 py-2 datepicker" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Capacity (Persons)</label>
                        <input type="number" name="capacity" value="{{ $dav->capacity }}" class="w-full border px-3 py-2" min="1" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Membership Type</label>
                        <select name="membership_id" class="w-full border px-3 py-2" required>
                            @foreach ($memberships as $membership)
                                <option value="{{ $membership->id }}" {{ $membership->id == $dav->membership_id ? 'selected' : '' }}>
                                    {{ $membership->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('editAvailableSpaceModal{{ $dav->id }}')" class="px-4 py-2 border">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-700 text-white">Update Space</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    {{-- ==================== JAVASCRIPT ==================== --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Simple Modal Functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Close modal when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[id$="Modal"]').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });

        // Date validation untuk available space
        document.querySelectorAll('input[name="start_date"]').forEach(startDateInput => {
            startDateInput.addEventListener('change', function() {
                const endDateInput = this.closest('form').querySelector('input[name="end_date"]');
                if (endDateInput) {
                    endDateInput.min = this.value;
                    // Jika end date sebelum start date, reset
                    if (endDateInput.value && endDateInput.value < this.value) {
                        endDateInput.value = this.value;
                    }
                }
            });
        });
    });

    // Delete confirmation
    function confirmDelete(event) {
        event.preventDefault();
        
        Swal.fire({
            title: "Are you sure?",
            text: "This data will be deleted permanently!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
        
        return false;
    }
    </script>

@endsection