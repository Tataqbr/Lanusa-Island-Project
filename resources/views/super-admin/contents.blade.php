@extends('layouts.super-admin')

@section('title', 'Manage Contents - Super Admin')

@section('content')
    <main class="mt-[20px] space-y-[40px]">
        {{-- Tabel 1: News & Update --}}
        <div class="bg-white border shadow-md p-6">
            <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
                <h2 class="text-xl font-semibold">News & Updates</h2>
                <button class="px-8 py-3 text-white bg-green-800 font-bold"
                        onclick="openModal('addNewsModal')">
                    Add Data
                </button>
            </div>
            <div class="overflow-x-auto">
                <table id="news" class="min-w-full text-left text-sm">
                    <thead class="text-white bg-dark">
                        <tr>
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Title</th>
                            <th class="py-3 px-4">Description</th>
                            <th class="py-3 px-4">Source</th>
                            <th class="py-3 px-4">Created At</th>
                            <th class="py-3 px-4">Image</th>
                            <th class="py-3 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataNews as $dn)
                            <tr>
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $dn->title }}</td>
                                <td class="py-3 px-4">
                                    <div class="max-w-[300px] truncate" title="{{ $dn->description }}">
                                        {{ Str::limit($dn->description, 50) }}
                                    </div>
                                </td>
                                <td class="py-3 px-4">{{ $dn->source }}</td>
                                <td class="py-3 px-4">{{ \Carbon\Carbon::parse($dn->created_at)->format('M d, Y') }}</td>
                                <td class="py-3 px-4">
                                    @if($dn->image)
                                        <img src="{{ asset('assets/news/' . $dn->image) }}" 
                                             alt="{{ $dn->title }}" 
                                             class="w-16 h-16 object-cover rounded cursor-pointer"
                                             onclick="showImageModal('{{ asset('assets/news/' . $dn->image) }}', '{{ $dn->title }}')">
                                    @else
                                        <span class="text-gray-500">No Image</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 flex items-center gap-3">
                                    <button class="p-2 bg-blue-800 text-white font-medium text-sm"
                                        onclick="openModal('editNewsModal{{ $dn->id }}')">
                                        Edit
                                    </button>
                                    <form action="{{ route('delete-news', $dn->id) }}" method="POST" onsubmit="return confirmDelete(event)">
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

        {{-- Tabel 2: Choose Plan --}}
        <div class="bg-white border shadow-md p-6">
            <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
                <h2 class="text-xl font-semibold">Choose Plan</h2>
                <button class="px-8 py-3 text-white bg-green-800 font-bold"
                        onclick="openModal('addPlanModal')">
                    Add Data
                </button>
            </div>
            <div class="overflow-x-auto">
                <table id="choose-plan" class="min-w-full text-left text-sm">
                    <thead class="text-white bg-dark">
                        <tr>
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Type</th>
                            <th class="py-3 px-4">Price</th>
                            <th class="py-3 px-4">Features</th>
                            <th class="py-3 px-4">Contract</th>
                            <th class="py-3 px-4">Created At</th>
                            <th class="py-3 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPlans as $dp)
                            <tr>
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $dp->type }}</td>
                                <td class="py-3 px-4">Rp{{ number_format($dp->price, 0, ',', '.') }}</td>
                                <td class="py-3 px-4">
                                    @php
                                        $features = json_decode($dp->features, true) ?? [];
                                    @endphp
                                    @if(count($features) > 0)
                                        <div class="max-w-[300px]">
                                            @foreach(array_slice($features, 0, 3) as $feature)
                                                <span class="block text-xs bg-gray-100 px-2 py-1 rounded mb-1">• {{ $feature }}</span>
                                            @endforeach
                                            @if(count($features) > 3)
                                                <span class="text-xs text-gray-500">+{{ count($features) - 3 }} more features</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-gray-500">No features</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">{{ $dp->contract }}</td>
                                <td class="py-3 px-4">{{ \Carbon\Carbon::parse($dp->created_at)->format('M d, Y') }}</td>
                                <td class="py-3 px-4 flex items-center gap-3">
                                    <button class="p-2 bg-blue-800 text-white font-medium text-sm"
                                        onclick="openModal('editPlanModal{{ $dp->id }}')">
                                        Edit
                                    </button>
                                    <form action="{{ route('delete-plan', $dp->id) }}" method="POST" onsubmit="return confirmDelete(event)">
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

    {{-- ==================== MODAL ADD NEWS ==================== --}}
    <div id="addNewsModal" class="fixed inset-0 bg-black/60 z-50 items-center justify-center hidden">
        <div class="bg-white w-[600px] rounded-lg shadow-lg mx-auto max-h-[90vh] overflow-y-auto mt-10">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Add News</h3>
                <form action="{{ route('add-news') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Title</label>
                        <input type="text" name="title" class="w-full border px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Description</label>
                        <textarea name="description" rows="4" class="w-full border px-3 py-2" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Source</label>
                        <input type="text" name="source" class="w-full border px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Image</label>
                        <input type="file" name="image" accept="image/*" class="w-full border px-3 py-2" required>
                        <p class="text-xs text-gray-500 mt-1">Max file size: 2MB | Formats: JPG, JPEG, PNG</p>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('addNewsModal')" class="px-4 py-2 border">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-700 text-white">Add News</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL EDIT NEWS ==================== --}}
    @foreach ($dataNews as $dn)
    <div id="editNewsModal{{ $dn->id }}" class="fixed inset-0 bg-black/60 z-50 items-center justify-center hidden">
        <div class="bg-white w-[600px] rounded-lg shadow-lg mx-auto mt-10 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Edit News</h3>
                <form action="{{ route('edit-news', $dn->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Title</label>
                        <input type="text" name="title" value="{{ $dn->title }}" class="w-full border px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Description</label>
                        <textarea name="description" rows="4" class="w-full border px-3 py-2" required>{{ $dn->description }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Source</label>
                        <input type="text" name="source" value="{{ $dn->source }}" class="w-full border px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Current Image</label>
                        @if($dn->image)
                            <img src="{{ asset('assets/news/' . $dn->image) }}" alt="{{ $dn->title }}" class="w-32 h-32 object-cover rounded mb-2">
                        @else
                            <span class="text-gray-500">No image</span>
                        @endif
                        <label class="block mb-2 font-medium mt-3">New Image (optional)</label>
                        <input type="file" name="image" accept="image/*" class="w-full border px-3 py-2">
                        <p class="text-xs text-gray-500 mt-1">Max file size: 2MB | Formats: JPG, JPEG, PNG</p>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('editNewsModal{{ $dn->id }}')" class="px-4 py-2 border">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-700 text-white">Update News</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    {{-- ==================== MODAL ADD PLAN ==================== --}}
    <div id="addPlanModal" class="fixed inset-0 bg-black/60 z-50 items-center justify-center hidden">
        <div class="bg-white w-[70%] rounded-lg shadow-lg mx-auto mt-8 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Add Plan</h3>
                <form action="{{ route('add-plan') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">Type</label>
                            <input type="text" name="type" class="w-full border px-3 py-2" placeholder="e.g., Basic, Premium, VIP" required>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">Price ($)</label>
                            <input type="number" name="price" class="w-full border px-3 py-2" min="0" step="0.01" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Contract Period</label>
                        <input type="text" name="contract" class="w-full border px-3 py-2" placeholder="e.g., 12 months, 1 year, Lifetime" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Features</label>
                        <div id="featuresContainer">
                            <div class="flex gap-2 mb-2">
                                <input type="text" name="features[]" class="flex-1 border px-3 py-2" placeholder="Enter feature" required>
                                <button type="button" onclick="removeFeature(this)" class="px-3 py-2 bg-red-600 text-white">Remove</button>
                            </div>
                        </div>
                        <button type="button" onclick="addFeature()" class="px-4 py-2 bg-green-600 text-white mt-2">Add More Feature</button>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('addPlanModal')" class="px-4 py-2 border">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-700 text-white">Add Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL EDIT PLAN ==================== --}}
    @foreach ($dataPlans as $dp)
    <div id="editPlanModal{{ $dp->id }}" class="fixed inset-0 bg-black/60 z-50 items-center justify-center hidden">
        <div class="bg-white w-[70%] rounded-lg shadow-lg mx-auto mt-8 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Edit Plan</h3>
                <form action="{{ route('edit-plan', $dp->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">Type</label>
                            <input type="text" name="type" value="{{ $dp->type }}" class="w-full border px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 font-medium">Price ($)</label>
                            <input type="number" name="price" value="{{ $dp->price }}" class="w-full border px-3 py-2" min="0" step="0.01" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Contract Period</label>
                        <input type="text" name="contract" value="{{ $dp->contract }}" class="w-full border px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Features</label>
                        <div id="featuresContainer{{ $dp->id }}">
                            @php
                                $features = json_decode($dp->features, true) ?? [];
                            @endphp
                            @if(count($features) > 0)
                                @foreach($features as $index => $feature)
                                    <div class="flex gap-2 mb-2">
                                        <input type="text" name="features[]" value="{{ $feature }}" class="flex-1 border px-3 py-2" placeholder="Enter feature" required>
                                        <button type="button" onclick="removeFeature(this)" class="px-3 py-2 bg-red-600 text-white">Remove</button>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex gap-2 mb-2">
                                    <input type="text" name="features[]" class="flex-1 border px-3 py-2" placeholder="Enter feature" required>
                                    <button type="button" onclick="removeFeature(this)" class="px-3 py-2 bg-red-600 text-white">Remove</button>
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addFeature('{{ $dp->id }}')" class="px-4 py-2 bg-green-600 text-white mt-2">Add More Feature</button>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('editPlanModal{{ $dp->id }}')" class="px-4 py-2 border">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-700 text-white">Update Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    {{-- ==================== IMAGE MODAL ==================== --}}
    <div id="imageModal" class="hidden fixed inset-0 bg-black/70 z-50 items-center justify-center">
        <div class="bg-white rounded-lg overflow-hidden max-w-[90%] max-h-[90%] relative mx-auto top-5">
            <button class="absolute top-2 right-2 bg-black text-white px-2 py-1 rounded text-sm hover:bg-gray-700"
                    onclick="closeImageModal()">✕</button>
            <img id="modalImage" src="" alt="Preview" class="w-full h-full object-contain">
            <div id="modalCaption" class="p-3 text-center text-gray-700 text-sm font-medium"></div>
        </div>
    </div>

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
    });

    // Features Management
    function addFeature(modalId = '') {
        const containerId = modalId ? `featuresContainer${modalId}` : 'featuresContainer';
        const container = document.getElementById(containerId);
        
        const featureDiv = document.createElement('div');
        featureDiv.className = 'flex gap-2 mb-2';
        featureDiv.innerHTML = `
            <input type="text" name="features[]" class="flex-1 border px-3 py-2" placeholder="Enter feature" required>
            <button type="button" onclick="removeFeature(this)" class="px-3 py-2 bg-red-600 text-white">Remove</button>
        `;
        
        container.appendChild(featureDiv);
    }

    function removeFeature(button) {
        const container = button.closest('div').parentElement;
        const featureInputs = container.querySelectorAll('input[name="features[]"]');
        
        if (featureInputs.length > 1) {
            button.closest('div').remove();
        } else {
            Swal.fire({
                title: 'Warning',
                text: 'At least one feature is required',
                icon: 'warning',
                confirmButtonColor: '#3085d6'
            });
        }
    }

    // Image Modal
    function showImageModal(src, caption) {
        document.getElementById('modalImage').src = src;
        document.getElementById('modalCaption').textContent = caption;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

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