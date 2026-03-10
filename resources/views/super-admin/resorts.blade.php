@extends('layouts.super-admin')

@section('title', 'Manage Resorts - Super Admin')

@section('content')
<main class="mt-[20px] space-y-[40px]">
    <div class="bg-white border shadow-md p-6">
        <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
            <h2 class="text-xl font-semibold">Resort Data</h2>
            <button 
                class="px-8 py-3 text-white bg-green-800 font-bold"
                onclick="openModal('addResortModal')">
                Add Data
            </button>
        </div>
        <div class="overflow-x-auto">
            <table id="resorts-admin" class="min-w-full text-left text-sm">
                <thead class="text-white bg-dark">
                    <tr>
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Destination</th>
                        <th class="py-3 px-4">Name</th>
                        <th class="py-3 px-4">Location</th>
                        <th class="py-3 px-4 w-[30%]">Description</th>
                        <th class="py-3 px-4">Facilities</th>
                        <th class="py-3 px-4">Price</th>
                        <th class="py-3 px-4">Images</th>
                        <th class="py-3 px-4">Created At</th>
                        <th class="py-3 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataResorts as $dr)
                        @php
                            $images = json_decode($dr->images ?? '[]', true);
                            $facilities = json_decode($dr->facilities ?? '[]', true);
                        @endphp
                        <tr data-resort-id="{{ $dr->id }}" data-images='@json($images)'>
                            <td class="py-3 px-4">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4">{{ $dr->destination }}</td>
                            <td class="py-3 px-4">{{ $dr->name }}</td>
                            <td class="py-3 px-4">{{ $dr->location }}</td>
                            <td class="py-3 px-4 w-[50%] whitespace-normal break-words">
                                <div class="line-clamp-4">
                                    {{ $dr->description }}
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                @if(is_array($facilities) && count($facilities) > 0)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($facilities, 0, 3) as $facility)
                                            <span class="bg-gray-100 px-2 py-1 text-xs rounded">{{ $facility }}</span>
                                        @endforeach
                                        @if(count($facilities) > 3)
                                            <span class="bg-gray-100 px-2 py-1 text-xs rounded">+{{ count($facilities) - 3 }} more</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-500">No facilities</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">Rp{{ number_format($dr->price, 0, ',', '.' ) }}</td>
                            <td class="py-3 px-4">
                                @if(count($images) > 0)
                                    <button 
                                        class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition"
                                        onclick="showImageCarouselModal({{ $dr->id }})">
                                        View Images ({{ count($images) }})
                                    </button>
                                @else
                                    <span class="text-gray-500">No images</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">{{ $dr->created_at }}</td>
                            <td class="py-3 px-4 flex items-center gap-3">
                                <button class="p-2 bg-blue-800 text-white font-medium"
                                    onclick="openModal('editResortModal{{ $dr->id }}')">
                                    Edit
                                </button>
                                <form action="{{ route('delete-resort', $dr->id) }}" method="POST"
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

{{-- ==================== MODAL CAROUSEL IMAGES ==================== --}}
<div id="imageCarouselModal" class="fixed inset-0 bg-black/70 z-50 items-center justify-center hidden">
    <div class="bg-white rounded-lg overflow-hidden max-w-[60%] w-full max-h-[90vh] relative mx-auto my-10">
        <button
            class="absolute top-4 right-4 bg-black text-white w-8 h-8 rounded-full z-10 hover:bg-gray-700 transition"
            onclick="closeModal('imageCarouselModal')"
        >✕</button>
        
        <div class="relative h-full">
            <div id="carouselContainer" class="h-[70vh] relative overflow-hidden">
                <!-- Images will be inserted here by JavaScript -->
            </div>
            
            <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white w-10 h-10 rounded-full hover:bg-black/70 transition hidden">
                ‹
            </button>
            <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white w-10 h-10 rounded-full hover:bg-black/70 transition hidden">
                ›
            </button>
            
            <div id="imageCounter" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black/50 text-white px-3 py-1 rounded-full text-sm hidden">
                <span id="currentImage">1</span> / <span id="totalImages">0</span>
            </div>
        </div>
        
        <div id="thumbnailsContainer" class="flex gap-2 p-4 overflow-x-auto bg-gray-100">
            <!-- Thumbnails will be inserted here by JavaScript -->
        </div>
    </div>
</div>

{{-- ==================== MODAL ADD RESORT ==================== --}}
<div id="addResortModal" class="fixed inset-0 bg-black/60 z-50 items-center justify-center hidden">
    <div class="bg-white w-[600px] max-h-[90vh] overflow-y-auto rounded-lg shadow-lg mx-auto mt-8">
        <div class="p-6">
            <h3 class="text-lg font-semibold mb-4">Add Resort</h3>
            <form action="{{ route('add-resort') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Destination</label>
                    <select name="destination_id" class="w-full border px-3 py-2" required>
                        <option value="">-- Select Destination --</option>
                        @foreach ($dataDestination as $dd)
                            <option value="{{ $dd->id }}">{{ $dd->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Resort Name</label>
                    <input type="text" name="name" class="w-full border px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Location</label>
                    <input type="text" name="location" class="w-full border px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Price</label>
                    <input type="number" name="price" class="w-full border px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Description</label>
                    <textarea name="description" rows="3" class="w-full border px-3 py-2"></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Facilities</label>
                    <div id="facilitiesContainer">
                        <div class="flex gap-2 mb-2">
                            <input type="text" name="facilities[]" class="flex-1 border px-3 py-2" placeholder="Enter facility" required>
                            <button type="button" onclick="removeFacility(this)" class="px-3 py-2 bg-red-600 text-white">Remove</button>
                        </div>
                    </div>
                    <button type="button" onclick="addFacility()" class="px-4 py-2 bg-green-600 text-white mt-2">Add More Facility</button>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Images (max 1MB each, multiple allowed)</label>
                    <input type="file" id="addImagesInput" name="images[]" multiple accept="image/*" class="w-full border px-3 py-2" required>
                    <div id="addImagesPreview" class="grid grid-cols-4 gap-2 mt-3"></div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('addResortModal')" class="px-4 py-2 border">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-green-700 text-white">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ==================== MODAL EDIT RESORT ==================== --}}
@foreach ($dataResorts as $dr)
<div id="editResortModal{{ $dr->id }}" class="fixed inset-0 bg-black/60 z-50 items-center justify-center hidden">
    <div class="bg-white w-[600px] max-h-[90vh] overflow-y-auto rounded-lg shadow-lg mx-auto mt-8">
        <div class="p-6">
            <h3 class="text-lg font-semibold mb-4">Edit Resort</h3>
            <form action="{{ route('edit-resort', $dr->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Destination</label>
                    <select name="destination_id" class="w-full border px-3 py-2" required>
                        <option value="">-- Select Destination --</option>
                        @foreach ($dataDestination as $dd)
                            <option value="{{ $dd->id }}" {{ $dd->id == $dr->destination_id ? 'selected' : '' }}>
                                {{ $dd->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Resort Name</label>
                    <input type="text" name="name" value="{{ $dr->name }}" class="w-full border px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Location</label>
                    <input type="text" name="location" value="{{ $dr->location }}" class="w-full border px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Price</label>
                    <input type="number" name="price" value="{{ $dr->price }}" class="w-full border px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Description</label>
                    <textarea name="description" rows="3" class="w-full border px-3 py-2">{{ $dr->description }}</textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block mb-2 font-medium">Facilities</label>
                    <div id="facilitiesContainer{{ $dr->id }}">
                        @php
                            $facilities = json_decode($dr->facilities ?? '[]', true);
                        @endphp
                        @if(is_array($facilities) && count($facilities) > 0)
                            @foreach($facilities as $index => $facility)
                                <div class="flex gap-2 mb-2">
                                    <input type="text" name="facilities[]" value="{{ $facility }}" class="flex-1 border px-3 py-2" placeholder="Enter facility" required>
                                    <button type="button" onclick="removeFacility(this)" class="px-3 py-2 bg-red-600 text-white">Remove</button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex gap-2 mb-2">
                                <input type="text" name="facilities[]" class="flex-1 border px-3 py-2" placeholder="Enter facility" required>
                                <button type="button" onclick="removeFacility(this)" class="px-3 py-2 bg-red-600 text-white">Remove</button>
                            </div>
                        @endif
                    </div>
                    <button type="button" onclick="addFacility('{{ $dr->id }}')" class="px-4 py-2 bg-green-600 text-white mt-2">Add More Facility</button>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Current Images</label>
                    <div class="grid grid-cols-4 gap-2 mb-2" id="currentImages{{ $dr->id }}">
                        @foreach (json_decode($dr->images ?? '[]') as $img)
                            <div class="relative">
                                <img src="{{ asset('assets/resorts/'.$img) }}" alt="Image" class="w-full h-24 object-cover rounded">
                            </div>
                        @endforeach
                    </div>

                    <label class="block mb-2 font-medium">Upload New Images (optional, will replace old ones)</label>
                    <input type="file" id="editImagesInput{{ $dr->id }}" name="images[]" multiple accept="image/*" class="w-full border px-3 py-2">
                    <div id="editImagesPreview{{ $dr->id }}" class="grid grid-cols-4 gap-2 mt-3"></div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('editResortModal{{ $dr->id }}')" class="px-4 py-2 border">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-700 text-white">Update</button>
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
});

// Facilities Management
function addFacility(modalId = '') {
    const containerId = modalId ? `facilitiesContainer${modalId}` : 'facilitiesContainer';
    const container = document.getElementById(containerId);
    
    const facilityDiv = document.createElement('div');
    facilityDiv.className = 'flex gap-2 mb-2';
    facilityDiv.innerHTML = `
        <input type="text" name="facilities[]" class="flex-1 border px-3 py-2" placeholder="Enter facility" required>
        <button type="button" onclick="removeFacility(this)" class="px-3 py-2 bg-red-600 text-white">Remove</button>
    `;
    
    container.appendChild(facilityDiv);
}

function removeFacility(button) {
    const container = button.closest('div').parentElement;
    const facilityInputs = container.querySelectorAll('input[name="facilities[]"]');
    
    if (facilityInputs.length > 1) {
        button.closest('div').remove();
    } else {
        Swal.fire({
            title: 'Warning',
            text: 'At least one facility is required',
            icon: 'warning',
            confirmButtonColor: '#3085d6'
        });
    }
}

// Image Carousel Modal
let currentCarouselImages = [];
let currentImageIndex = 0;

function showImageCarouselModal(resortId) {
    const resortRow = document.querySelector(`tr[data-resort-id="${resortId}"]`);
    const images = JSON.parse(resortRow.getAttribute('data-images') || '[]');
    
    currentCarouselImages = images;
    currentImageIndex = 0;
    
    updateCarousel();
    openModal('imageCarouselModal');
}

function updateCarousel() {
    const container = document.getElementById('carouselContainer');
    const thumbnailsContainer = document.getElementById('thumbnailsContainer');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const imageCounter = document.getElementById('imageCounter');
    const currentImageSpan = document.getElementById('currentImage');
    const totalImagesSpan = document.getElementById('totalImages');
    
    container.innerHTML = '';
    thumbnailsContainer.innerHTML = '';
    
    if (currentCarouselImages.length === 0) return;
    
    currentImageSpan.textContent = currentImageIndex + 1;
    totalImagesSpan.textContent = currentCarouselImages.length;
    
    prevBtn.classList.toggle('hidden', currentCarouselImages.length <= 1);
    nextBtn.classList.toggle('hidden', currentCarouselImages.length <= 1);
    imageCounter.classList.toggle('hidden', currentCarouselImages.length <= 1);
    
    const mainImg = document.createElement('img');
    mainImg.src = `/assets/resorts/${currentCarouselImages[currentImageIndex]}`;
    mainImg.alt = `Image ${currentImageIndex + 1}`;
    mainImg.className = 'w-full h-full object-contain';
    container.appendChild(mainImg);
    
    currentCarouselImages.forEach((image, index) => {
        const thumbBtn = document.createElement('button');
        thumbBtn.type = 'button';
        thumbBtn.className = `flex-shrink-0 w-16 h-16 border-2 ${index === currentImageIndex ? 'border-blue-500' : 'border-transparent'}`;
        thumbBtn.onclick = () => {
            currentImageIndex = index;
            updateCarousel();
        };
        
        const thumbImg = document.createElement('img');
        thumbImg.src = `/assets/resorts/${image}`;
        thumbImg.alt = `Thumbnail ${index + 1}`;
        thumbImg.className = 'w-full h-full object-cover';
        
        thumbBtn.appendChild(thumbImg);
        thumbnailsContainer.appendChild(thumbBtn);
    });
}

document.getElementById('prevBtn')?.addEventListener('click', () => {
    if (currentCarouselImages.length > 0) {
        currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : currentCarouselImages.length - 1;
        updateCarousel();
    }
});

document.getElementById('nextBtn')?.addEventListener('click', () => {
    if (currentCarouselImages.length > 0) {
        currentImageIndex = currentImageIndex < currentCarouselImages.length - 1 ? currentImageIndex + 1 : 0;
        updateCarousel();
    }
});

// Image preview functions
function previewImages(input, previewId) {
    const container = document.getElementById(previewId);
    container.innerHTML = '';
    const files = input.files;

    for (let file of files) {
        if (file.size > 1048576) {
            Swal.fire({
                title: 'File too large',
                text: 'Each image must be under 1 MB.',
                icon: 'error',
                confirmButtonColor: '#3085d6'
            });
            input.value = '';
            container.innerHTML = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function(evt) {
            const img = document.createElement('img');
            img.src = evt.target.result;
            img.className = 'w-24 h-24 object-cover rounded-md border';
            container.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}

// Initialize image previews
document.addEventListener('DOMContentLoaded', function() {
    const addImagesInput = document.getElementById('addImagesInput');
    if (addImagesInput) {
        addImagesInput.addEventListener('change', function(e) {
            previewImages(this, 'addImagesPreview');
        });
    }

    @foreach ($dataResorts as $dr)
    const editImagesInput{{ $dr->id }} = document.getElementById('editImagesInput{{ $dr->id }}');
    if (editImagesInput{{ $dr->id }}) {
        editImagesInput{{ $dr->id }}.addEventListener('change', function(e) {
            previewImages(this, 'editImagesPreview{{ $dr->id }}');
        });
    }
    @endforeach
});

// Delete confirmation
function confirmDelete(event) {
    event.preventDefault();
    
    Swal.fire({
        title: "Are you sure?",
        text: "This resort data will be deleted permanently!",
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