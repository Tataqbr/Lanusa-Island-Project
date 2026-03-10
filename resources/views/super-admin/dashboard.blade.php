@extends('layouts.super-admin')

@section('title', 'Super Admin Dashboard')

@section('content')
    <main class="mt-[20px] space-y-[40px]">
        
        {{-- ==== 8 CARD STATISTIK ==== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white shadow-md border p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-gray-500 text-sm font-medium">Total Admins</h2>
                    <h1 class="text-3xl font-bold mt-2">{{ $totalAdmin }}</h1>
                </div>
                <i class="fa-solid fa-users-gear text-3xl mt-3 text-secondary"></i>
            </div>
            
            <div class="bg-white shadow-md border p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-gray-500 text-sm font-medium">Total Members</h2>
                    <h1 class="text-3xl font-bold mt-2">{{ $totalMember }}</h1>
                </div>
                <i class="fa-solid fa-users text-3xl mt-3 text-secondary"></i>
            </div>

            <div class="bg-white shadow-md border p-6 flex flex-col justify-between col-span-2">
                <div>
                    <h2 class="text-gray-500 text-sm font-medium">Total Destinations</h2>
                    <h1 class="text-3xl font-bold mt-2">{{ $totalDestination }}</h1>
                </div>
                <i class="fa-solid fa-map-location-dot text-3xl mt-3 text-secondary"></i>
            </div>

            <div class="bg-white shadow-md border p-6 flex flex-col justify-between col-span-3">
                <div>
                    <h2 class="text-gray-500 text-sm font-medium">Total Resorts</h2>
                    <h1 class="text-3xl font-bold mt-2">{{ $totalResort }}</h1>
                </div>
                <i class="fa-solid fa-location-dot text-3xl mt-3 text-secondary"></i>
            </div>

            <div class="bg-white shadow-md border p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-gray-500 text-sm font-medium">Not Paid</h2>
                    <h1 class="text-3xl font-bold mt-2">{{ $notPaid }}</h1>
                </div>
                <i class="fa-solid fa-sack-dollar text-3xl mt-3 text-secondary"></i>
            </div>

            {{-- <div class="bg-white shadow-md border p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-gray-500 text-sm font-medium">Admin Request</h2>
                    <h1 class="text-3xl font-bold mt-2">{{ $requestAdmin }}</h1>
                </div>
                <i class="fa-solid fa-user-tie text-3xl mt-3 text-secondary"></i>
            </div>

            <div class="bg-white shadow-md border p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-gray-500 text-sm font-medium">User Request</h2>
                    <h1 class="text-3xl font-bold mt-2">{{ $requestUser }}</h1>
                </div>
                <i class="fa-solid fa-person-circle-question text-3xl mt-3 text-secondary"></i>
            </div> --}}

            {{-- <div class="bg-white shadow-md border p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-gray-500 text-sm font-medium">Saldo</h2>
                    <h1 class="text-3xl font-bold mt-2">$999</h1>
                </div>
                <i class="fa-solid fa-money-bill-trend-up text-3xl mt-3 text-secondary"></i>
            </div> --}}
        </div>

       {{-- ==== TABEL BOOKING ==== --}}
<div class="bg-white border shadow-md p-6">
    <h2 class="text-xl font-semibold mb-4 pb-6 border-b-2">Booking Data</h2>
    <div class="overflow-x-auto">
        <table id="booking-data" class="min-w-full text-left text-sm">
            <thead class="text-white bg-dark">
                <tr>
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Membership</th>
                    <th class="py-3 px-4">Destination</th>
                    <th class="py-3 px-4">Resort</th>
                    <th class="py-3 px-4">Stay Duration</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Total Price</th>
                    <th class="py-3 px-4">Method</th>
                    <th class="py-3 px-4">Proof</th>
                    <th class="py-3 px-4">Date</th>
                    <th class="py-3 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataBooking as $db)
                    <tr>
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">{{ $db->user }}</td>
                        <td class="py-3 px-4">{{ $db->email }}</td>
                        <td class="py-3 px-4">{{ $db->membership }}</td>
                        <td class="py-3 px-4">{{ $db->destination }}</td>
                        <td class="py-3 px-4">{{ $db->resort }}</td>
                        <td class="py-3 px-4">
                            {{ \Carbon\Carbon::parse($db->start_date)->format('M d, Y') }} - 
                            {{ \Carbon\Carbon::parse($db->end_date)->format('M d, Y') }} 
                            ({{ $db->duration }} Days)
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded text-xs font-medium 
                                @if($db->status == 'waiting_payment') bg-yellow-100 text-yellow-800
                                @elseif($db->status == 'success') bg-green-100 text-green-800
                                @elseif($db->status == 'rejected') bg-red-100 text-red-800
                                @elseif($db->status == 'confirmed') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ str_replace('_', ' ', ucfirst($db->status)) }}
                            </span>
                        </td>
                        
                        <td class="py-3 px-4">${{ number_format($db->total_price, 2) }}</td>
                        
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded text-xs 
                                @if($db->method == 'bank_transfer') bg-blue-100 text-blue-800
                                @elseif($db->method == 'midtrans') bg-green-100 text-green-800
                                @elseif($db->method == 'xendit') bg-purple-100 text-purple-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $db->method }}
                            </span>
                        </td>
                        
                        <td class="py-3 px-4">
                            @if($db->method == 'bank_transfer' && $db->proof)
                                <button onclick="showBookingProofModal('{{ asset($db->proof) }}')" 
                                        class="p-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 transition-colors">
                                    View Proof
                                </button>
                            @else
                                <span class="text-gray-500 text-xs">Nothing</span>
                            @endif
                        </td>
                        
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($db->created_at)->format('M d, Y') }}</td>
                        
                        <td class="py-3 px-4 flex items-center gap-2">
                            @if($db->status == 'success')
                                <form action="{{ route('accept-booking', $db->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700 transition-colors">
                                        Accept
                                    </button>
                                </form>
                            @elseif($db->status == 'confirmed')
                                <button disabled class="p-2 bg-blue-800 text-white text-xs font-medium rounded opacity-50 cursor-not-allowed">
                                    Confirmed
                                </button>
                            @else
                                <span class="text-gray-500 text-xs">No action</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Booking Proof Modal -->
<div id="bookingProofModal" class="fixed inset-0 bg-black/80 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-2xl w-auto mx-auto">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold">Booking Payment Proof</h3>
            <button onclick="closeBookingProofModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-4">
            <img id="bookingProofImage" src="" alt="Booking Payment Proof" class="w-[300px] h-auto rounded">
        </div>
    </div>
</div>

        {{-- ==== TABEL GATEWAYS ==== --}}
       <div class="bg-white border shadow-md p-6">
    <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
        <h2 class="text-xl font-semibold">Payment Gateways</h2>
    </div>
    <div class="overflow-x-auto">
        <table id="gateways" class="min-w-full text-left text-sm">
            <thead class="text-white bg-dark">
                <tr>
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Code</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataGateways as $dg)
                    <tr>
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">{{ $dg->name }}</td>
                        <td class="py-3 px-4">{{ $dg->code }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded text-xs font-medium 
                                {{ $dg->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($dg->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 flex items-center gap-3">
                            <button onclick="openEditModal({{ $dg->id }}, '{{ $dg->name }}', '{{ $dg->code }}', '{{ $dg->status }}')" 
                                    class="p-2 bg-blue-600 text-white font-medium text-sm hover:bg-blue-700 rounded">
                                Edit
                            </button>
                            
                            <form action="{{ route('gateway-toggle-status', $dg->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-2 {{ $dg->status === 'active' ? 'bg-orange-600 hover:bg-orange-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-medium text-sm rounded">
                                    {{ $dg->status === 'active' ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                            
                            <form action="{{ route('delete-gateway', $dg->id) }}" method="POST"
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

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-xl font-medium">Edit Payment Gateway</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    ✕
                </button>
            </div>
            
            <form id="editForm" method="POST">
                @csrf
                @method('POST')
                
                <div class="mt-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Name</label>
                        <input type="text" id="edit_name" name="name" 
                               class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Code</label>
                        <input type="text" id="edit_code" name="code" 
                               class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Status</label>
                        <select id="edit_status" name="status" class="w-full p-2 border rounded" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()" 
                            class="px-4 py-2 border rounded hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update Gateway
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentEditId = null;

function openEditModal(id, name, code, status) {
    currentEditId = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_code').value = code;
    document.getElementById('edit_status').value = status;
    document.getElementById('editForm').action = `edit-payment-gateway/${id}`;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    currentEditId = null;
}

// Close modal when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target.id === 'editModal') {
        closeEditModal();
    }
});
</script>
    </main>

    {{-- ==================== MODAL CREATE USER ==================== --}}
    {{-- <div id="createUserModal" class="fixed inset-0 bg-black/60 z-50 items-center justify-center hidden">
        <div class="bg-white w-[500px] rounded-lg shadow-lg m-4 mx-auto">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Create User Account</h3>
                <form id="createUserForm" method="POST">
                    @csrf
                    <input type="hidden" name="request_id" id="userRequestId">
                    
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Username <span class="text-red-500">*</span></label>
                        <input type="text" name="username" id="userUsername" class="w-full border px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <p class="text-xs text-gray-500 mt-1">Username must be unique and will be used for login</p>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" id="userPassword" class="w-full border px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <div class="flex gap-2 mt-2">
                            <button type="button" onclick="generatePassword()" class="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded hover:bg-blue-200 transition-colors">
                                Generate Strong Password
                            </button>
                            <button type="button" onclick="togglePasswordVisibility('userPassword')" class="text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded hover:bg-gray-200 transition-colors">
                                Show/Hide
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters with uppercase, lowercase, number, and symbol</p>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block mb-2 font-medium">Confirm Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" id="userPasswordConfirm" class="w-full border px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    </div>
                    
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal('createUserModal')" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-md hover:bg-green-800 transition-colors">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    {{-- ==================== JAVASCRIPT ==================== --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Simple Modal Functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Image Modal
    function showImageModal(src, caption) {
        document.getElementById('modalImage').src = src;
        document.getElementById('modalCaption').textContent = caption;
        openModal('imageModal');
    }

    // Create User Modal
    function openCreateUserModal(requestId, userEmail) {
        console.log('Opening modal for request ID:', requestId, 'Email:', userEmail);
        
        // Set hidden input dengan request ID
        document.getElementById('userRequestId').value = requestId;
        
        // Generate username dari email
        const username = userEmail.split('@')[0];
        document.getElementById('userUsername').value = username;
        
        // Set form action dengan route yang benar
        document.getElementById('createUserForm').action = `/create-user/${requestId}`;
        
        // Generate initial password
        generatePassword();
        
        // Buka modal
        openModal('createUserModal');
    }

    // Edit Admin Modal
    function openEditAdminModal(requestId, username, password) {
        document.getElementById('adminRequestId').value = requestId;
        document.getElementById('adminUsername').value = username;
        document.getElementById('adminPassword').value = password;
        
        // Set form action
        document.getElementById('editAdminForm').action = `/update-admin-request/${requestId}`;
        
        openModal('editAdminModal');
    }

    // SweetAlert for Delete Confirmation
    function confirmDeleteUserRequest(requestId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            background: '#fff',
            color: '#333'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form
                document.getElementById(`delete-user-request-${requestId}`).submit();
            }
        });
    }

    // Password Generation
    function generatePassword() {
        const password = generateStrongPassword();
        document.getElementById('userPassword').value = password;
        document.getElementById('userPasswordConfirm').value = password;
    }

    function generateAdminPassword() {
        document.getElementById('adminPassword').value = generateStrongPassword();
    }

    function generateStrongPassword(length = 12) {
        const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const lowercase = 'abcdefghijklmnopqrstuvwxyz';
        const numbers = '0123456789';
        const symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?';

        let password = '';
        password += uppercase[Math.floor(Math.random() * uppercase.length)];
        password += lowercase[Math.floor(Math.random() * lowercase.length)];
        password += numbers[Math.floor(Math.random() * numbers.length)];
        password += symbols[Math.floor(Math.random() * symbols.length)];

        const allCharacters = uppercase + lowercase + numbers + symbols;
        for (let i = 4; i < length; i++) {
            password += allCharacters[Math.floor(Math.random() * allCharacters.length)];
        }

        return password.split('').sort(() => 0.5 - Math.random()).join('');
    }

    // Toggle Password Visibility
    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    // Close modals when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[id$="Modal"]').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });

        // Auto-generate password on page load for user modal
        generatePassword();
    });

    // Form validation dengan SweetAlert
    document.getElementById('createUserForm')?.addEventListener('submit', function(e) {
        const password = document.getElementById('userPassword').value;
        const confirmPassword = document.getElementById('userPasswordConfirm').value;
        const username = document.getElementById('userUsername').value;
        
        if (!username.trim()) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Username is required!',
                background: '#fff',
                color: '#333'
            });
            return false;
        }
        
        if (username.length < 3) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Username must be at least 3 characters long!',
                background: '#fff',
                color: '#333'
            });
            return false;
        }
        
        if (password !== confirmPassword) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Passwords do not match!',
                background: '#fff',
                color: '#333'
            });
            return false;
        }
        
        if (password.length < 8) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Password must be at least 8 characters long!',
                background: '#fff',
                color: '#333'
            });
            return false;
        }
        
        // Validasi password strength
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumbers = /\d/.test(password);
        const hasSymbols = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
        
        if (!hasUpperCase || !hasLowerCase || !hasNumbers || !hasSymbols) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Weak Password',
                html: 'For better security, please use a password that contains:<br>' +
                      '• Uppercase letters<br>' +
                      '• Lowercase letters<br>' +
                      '• Numbers<br>' +
                      '• Symbols',
                background: '#fff',
                color: '#333',
                confirmButtonText: 'Use Anyway',
                showCancelButton: true,
                cancelButtonText: 'Generate New'
            }).then((result) => {
                if (result.isDismissed) {
                    generatePassword();
                }
            });
            return false;
        }
    });

    // Prevent modal close when clicking inside modal content
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.bg-white').forEach(modalContent => {
            modalContent.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    });
    </script>


<script>
    // Booking Proof Modal Functions
function showBookingProofModal(imageSrc) {
    console.log('Opening booking proof modal with image:', imageSrc);
    document.getElementById('bookingProofImage').src = imageSrc;
    document.getElementById('bookingProofModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeBookingProofModal() {
    console.log('Closing booking proof modal');
    document.getElementById('bookingProofModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside the image
document.getElementById('bookingProofModal').addEventListener('click', function(e) {
    if (e.target.id === 'bookingProofModal') {
        closeBookingProofModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeBookingProofModal();
    }
});
</script>
@endsection