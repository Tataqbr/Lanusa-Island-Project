@extends('layouts.super-admin')

@section('title', 'Manage Admins - Super Admin')

@section('content')
    <main class="mt-[20px] space-y-[40px]">

        <div class="bg-white border shadow-md p-6">
            <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
                <h2 class="text-xl font-semibold">Admin Data</h2>

                <div class="flex items-center gap-x-3">
                    {{-- <button class="px-8 py-3 text-white bg-yellow-800 font-bold">
                        Export Data
                    </button> --}}
                    <button class="px-8 py-3 text-white bg-green-800 font-bold"
                    data-modal-target="addAdminModal"
                    data-modal-toggle="addAdminModal">
                        Add Data
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="users-admin" class="min-w-full text-left text-sm">
                    <thead class="text-white bg-dark">
                        <tr>
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Name</th>
                            <th class="py-3 px-4">Division</th>
                            <th class="py-3 px-4">Username</th>
                            <th class="py-3 px-4">Password</th>
                            <th class="py-3 px-4">Created At</th>
                            <th class="py-3 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataAdmins as $da)
                            <tr>
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $da->name }}</td>
                                <td class="py-3 px-4">{{ $da->division }}</td>
                                <td class="py-3 px-4">{{ $da->username }}</td>
                                <td class="py-3 px-4">{{ $da->password }}</td>
                                <td class="py-3 px-4">{{ $da->created_at }}</td>
                                <td class="py-3 px-4 flex items-center gap-3">
                                    <button class="p-2 bg-blue-800 text-white font-medium"
                                        data-modal-target="editAdminModal{{ $da->id }}"
                                        data-modal-toggle="editAdminModal{{ $da->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('delete-admin', $da->id) }}" method="POST"
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

    {{-- ==================== MODAL ADD ADMIN ==================== --}}
<div id="addAdminModal" class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50">
    <div class="bg-white w-[500px] p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Add Admin</h3>
        <form action="{{ route('add-admin') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-medium">Name</label>
                <input type="text" name="name" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Division</label>
                <input type="text" name="division" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Username</label>
                <input type="text" name="username" class="w-full border px-3 py-2" required>
                @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Password</label>
                <input type="text" name="password" class="w-full border px-3 py-2" required>
                @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" data-modal-hide="addAdminModal" class="px-4 py-2 border">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white">Save</button>
            </div>
        </form>
    </div>
</div>

{{-- ==================== MODAL EDIT ADMIN (UNTUK SETIAP DATA) ==================== --}}
@foreach ($dataAdmins as $dta)
<div id="editAdminModal{{ $dta->id }}" class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50">
    <div class="bg-white w-[500px] p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Edit Admin</h3>
        <form action="{{ route('edit-admin', $dta->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-medium">Name</label>
                <input type="text" name="name" value="{{ $dta->name }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Division</label>
                <input type="text" name="division" value="{{ $dta->division }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Username</label>
                <input type="text" name="username" value="{{ $dta->username }}" class="w-full border px-3 py-2" required>
                @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Password</label>
                <input type="text" name="password" value="{{ $dta->password }}" class="w-full border px-3 py-2" required>
                 @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" data-modal-hide="editAdminModal{{ $dta->id }}" class="px-4 py-2 border">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-700 text-white">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>
function confirmDelete(event) {
    event.preventDefault();
    
    const form = event.target;

    Swal.fire({
        title: "Are you sure?",
        text: "This data will be deleted permanently!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });

    return false;
}
</script>
@endsection
