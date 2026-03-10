@extends('layouts.super-admin')

@section('title', 'Manage Destinations - Super Admin')

@section('content')
<main class="mt-[20px] space-y-[40px]">

    {{-- ==================== REGION DATA ==================== --}}
    <div class="bg-white border shadow-md p-6">
        <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
            <h2 class="text-xl font-semibold">Region Data</h2>
            <button 
                class="px-8 py-3 text-white bg-green-800 font-bold"
                data-modal-target="addRegionModal"
                data-modal-toggle="addRegionModal">
                Add Data
            </button>
        </div>

        <div class="overflow-x-auto">
            <table id="region" class="min-w-full text-left text-sm">
                <thead class="text-white bg-dark">
                    <tr>
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Name</th>
                        <th class="py-3 px-4">Created At</th>
                        <th class="py-3 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataRegion as $dr)
                    <tr>
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">{{ $dr->name }}</td>
                        <td class="py-3 px-4">{{ $dr->created_at }}</td>
                        <td class="py-3 px-4 flex items-center gap-3">
                            <button class="p-2 bg-blue-800 text-white font-medium edit-region-btn"
                                data-modal-target="editRegionModal{{ $dr->id }}"
                                data-modal-toggle="editRegionModal{{ $dr->id }}">
                                Edit
                            </button>
                            <form action="{{ route('delete-region', $dr->id) }}" method="POST" onsubmit="return confirmDelete(event)">
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

    {{-- ==================== DESTINATION DATA ==================== --}}
    <div class="bg-white border shadow-md p-6">
        <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
            <h2 class="text-xl font-semibold">Destination Data</h2>
            <button 
                class="px-8 py-3 text-white bg-green-800 font-bold"
                data-modal-target="addDestinationModal"
                data-modal-toggle="addDestinationModal">
                Add Data
            </button>
        </div>

        <div class="overflow-x-auto">
    <table id="destinations-admin" class="min-w-full text-left text-sm">
        <thead class="text-white bg-dark">
            <tr>
                <th class="py-3 px-4">No</th>
                <th class="py-3 px-4">Region</th>
                <th class="py-3 px-4">Destination</th>
                <th class="py-3 px-4 w-[30%]">Description</th> {{-- batas lebar --}}
                <th class="py-3 px-4 w-full">Image</th>
                <th class="py-3 px-4">Created At</th>
                <th class="py-3 px-4">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataDestination as $dd)
            <tr class="border-b">
                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                <td class="py-3 px-4">{{ $dd->region }}</td>
                <td class="py-3 px-4">{{ $dd->name }}</td>

                {{-- description tidak melebar penuh --}}
                <td class="py-3 px-4 w-[50%] whitespace-normal break-words">
                    <div class="line-clamp-4"> {{-- tampil maksimal 4 baris --}}
                        {{ $dd->description }}
                    </div>
                </td>

                {{-- image persegi + modal popup --}}
                <td class="py-3 px-4">
                    <img
                        src="{{ asset('assets/destinations/'.$dd->image) }}"
                        alt="{{ $dd->name }} - Image"
                        class="w-[300px] h-auto object-cover rounded-md shadow-md cursor-pointer hover:opacity-80 transition"
                        onclick="showImageModal('{{ asset('assets/destinations/'.$dd->image) }}', '{{ $dd->name }}')"
                    >
                </td>

                <td class="py-3 px-4">{{ $dd->created_at }}</td>

                <td class="py-3 px-4 flex items-center gap-3">
                    <button class="p-2 bg-blue-800 text-white font-medium"
                        data-modal-target="editDestinationModal{{ $dd->id }}"
                        data-modal-toggle="editDestinationModal{{ $dd->id }}">
                        Edit
                    </button>
                    <form action="{{ route('delete-destination', $dd->id) }}" method="POST" onsubmit="return confirmDelete(event)">
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

{{-- Modal pop-up untuk gambar --}}
<div id="imageModal" class="hidden fixed inset-0 bg-black/70 z-50 items-center justify-center">
    <div class="bg-white rounded-lg overflow-hidden max-w-[90%] max-h-[90%] relative mx-auto top-5">
        <button
            class="absolute top-2 right-2 bg-black text-white px-2 py-1 rounded text-sm hover:bg-gray-700"
            onclick="closeImageModal()"
        >✕</button>
        <img id="modalImage" src="" alt="Preview" class="w-full h-full object-contain">
        <div id="modalCaption" class="p-3 text-center text-gray-700 text-sm font-medium"></div>
    </div>
</div>

<script>
    function showImageModal(src, caption) {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('modalImage');
        const cap = document.getElementById('modalCaption');
        img.src = src;
        cap.textContent = caption;
        modal.classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    // klik di luar modal untuk close
    window.addEventListener('click', function (e) {
        const modal = document.getElementById('imageModal');
        if (e.target === modal) {
            closeImageModal();
        }
    });
</script>

    </div>

</main>

{{-- ==================== MODAL ADD REGION ==================== --}}
<div id="addRegionModal" class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50">
    <div class="bg-white w-[400px] p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Add Region</h3>
        <form action="{{ route('add-region') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-medium">Region Name</label>
                <input type="text" name="name" class="w-full border px-3 py-2" required>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" data-modal-hide="addRegionModal" class="px-4 py-2 border">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white">Save</button>
            </div>
        </form>
    </div>
</div>

{{-- ==================== MODAL EDIT REGION (UNTUK SETIAP DATA) ==================== --}}
@foreach ($dataRegion as $dr)
<div id="editRegionModal{{ $dr->id }}" class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50">
    <div class="bg-white w-[400px] p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Edit Region</h3>
        <form action="{{ route('edit-region', $dr->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-medium">Region Name</label>
                <input type="text" name="name" value="{{ $dr->name }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" data-modal-hide="editRegionModal{{ $dr->id }}" class="px-4 py-2 border">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-700 text-white">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- ==================== MODAL ADD DESTINATION ==================== --}}
<div id="addDestinationModal" class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50 overflow-y-auto">
    <div class="bg-white w-[500px] p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Add Destination</h3>
        <form action="{{ route('add-destination') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-medium">Region</label>
                <select name="region_id" class="w-full border px-3 py-2" required>
                    <option value="">-- Select Region --</option>
                    @foreach ($dataRegion as $dr)
                        <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Destination Name</label>
                <input type="text" name="name" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Description</label>
                <textarea name="description" rows="3" class="w-full border px-3 py-2"></textarea>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Image (max 1MB)</label>
                <input type="file" id="addImageInput" name="image" accept="image/*" class="w-full border px-3 py-2" required>
                <img id="addImagePreview" class="mt-3 w-full h-48 object-cover hidden" alt="Preview">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" data-modal-hide="addDestinationModal" class="px-4 py-2 border">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white">Save</button>
            </div>
        </form>
    </div>
</div>

{{-- ==================== MODAL EDIT DESTINATION (UNTUK SETIAP DATA) ==================== --}}
@foreach ($dataDestination as $dd)
<div id="editDestinationModal{{ $dd->id }}" class="hidden fixed inset-0 bg-black/60 items-center justify-center z-50 overflow-y-auto py-10">
    <div class="bg-white w-[500px] p-6 rounded-lg shadow-lg my-auto">
        <h3 class="text-lg font-semibold mb-4">Edit Destination</h3>
        <form action="{{ route('edit-destination', $dd->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-medium">Region</label>
                <select name="region_id" class="w-full border px-3 py-2" required>
                    <option value="">-- Select Region --</option>
                    @foreach ($dataRegion as $dr)
                        <option value="{{ $dr->id }}" {{ $dr->id == $dd->region_id ? 'selected' : '' }}>
                            {{ $dr->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Destination Name</label>
                <input type="text" name="name" value="{{ $dd->name }}" class="w-full border px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Description</label>
                <textarea name="description" rows="3" class="w-full border px-3 py-2">{{ $dd->description }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-medium">Current Image</label>
                <img src="{{ asset('assets/destinations/'.$dd->image) }}" alt="Current Image" class="w-full h-48 object-cover mb-2">
                <label class="block mb-2 font-medium">New Image (max 1MB, optional)</label>
                <input type="file" name="image" accept="image/*" class="w-full border px-3 py-2">
                <small class="text-gray-500">Leave empty to keep current image</small>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" data-modal-hide="editDestinationModal{{ $dd->id }}" class="px-4 py-2 border">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-700 text-white">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- ==================== SWEETALERT DELETE ==================== --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Function untuk konfirmasi delete
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

// Image preview untuk modal add destination
document.getElementById('addImageInput')?.addEventListener('change', function(e){
    const file = e.target.files[0];
    const preview = document.getElementById('addImagePreview');
    if (file) {
        if (file.size > 1048576) {
            Swal.fire('File too large', 'Maximum size allowed is 1 MB.', 'error');
            e.target.value = '';
            preview.classList.add('hidden');
            return;
        }
        const reader = new FileReader();
        reader.onload = function(event){
            preview.src = event.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
});

// Modal functionality
document.addEventListener('DOMContentLoaded', function() {
    // Modal toggle functionality
    const modalTriggers = document.querySelectorAll('[data-modal-toggle]');
    const modalHides = document.querySelectorAll('[data-modal-hide]');
    
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const target = this.getAttribute('data-modal-target');
            const modal = document.querySelector(target);
            if (modal) {
                modal.classList.remove('hidden');
            }
        });
    });
    
    modalHides.forEach(hide => {
        hide.addEventListener('click', function() {
            const target = this.getAttribute('data-modal-hide');
            const modal = document.querySelector(target);
            if (modal) {
                modal.classList.add('hidden');
            }
        });
    });
    
    // Close modal when clicking outside
    const modals = document.querySelectorAll('[id$="Modal"]');
    modals.forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    });
});
</script>

@endsection