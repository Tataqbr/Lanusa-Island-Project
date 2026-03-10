@extends('layouts.super-admin')

@section('title', 'Manage Reports - Super Admin')

@section('content')
    <main class="mt-[20px] space-y-[40px]">
    
            {{-- Tabel 3: Payment Registration Data --}}
            <div class="bg-white border shadow-md p-6">
    <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
        <h2 class="text-xl font-semibold">Payment Registration</h2>
    </div>
    <div class="overflow-x-auto">
        <table id="payment-registration" class="min-w-full text-left text-sm">
            <thead class="text-white bg-dark">
                <tr>
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Phone</th>
                    <th class="py-3 px-4">State</th>
                    <th class="py-3 px-4">Membership</th>
                    <th class="py-3 px-4">Amount</th>
                    <th class="py-3 px-4">Method</th>
                    <th class="py-3 px-4">Proof</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Date</th>
                    <th class="py-3 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataRegistration as $drt)
                    <tr>
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">{{ $drt->name }}</td>
                        <td class="py-3 px-4">{{ $drt->email }}</td>
                        <td class="py-3 px-4">{{ $drt->phone }}</td>
                        <td class="py-3 px-4">{{ $drt->state }}</td>
                        <td class="py-3 px-4">{{ $drt->type }}</td>
                        <td class="py-3 px-4">Rp{{ number_format($drt->amount, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded text-xs 
                                @if($drt->method == 'bank_transfer') bg-blue-100 text-blue-800
                                @elseif($drt->method == 'midtrans') bg-green-100 text-green-800
                                @elseif($drt->method == 'xendit') bg-purple-100 text-purple-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $drt->method }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            @if($drt->method == 'bank_transfer' && $drt->proof)
                                <button onclick="showProofModal('{{ asset($drt->proof) }}')" 
                                        class="p-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
                                    View Proof
                                </button>
                            @else
                                <span class="text-gray-500 text-xs">Nothing</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded text-xs 
                                @if($drt->status == 'success') bg-green-100 text-green-800
                                @elseif($drt->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($drt->status == 'failed') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $drt->status }}
                            </span>
                        </td>
                        <td class="py-3 px-4">{{ date('M d, Y H:i', strtotime($drt->created_at)) }}</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            @if($drt->status == 'pending')
                                <button onclick="approvePayment('{{ $drt->id }}', '{{ $drt->name }}', '{{ $drt->email }}')" 
                                        class="p-2 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700 transition-colors">
                                    Approve
                                </button>
                            @else
                                <button disabled class="p-2 bg-gray-400 text-white text-xs font-medium rounded cursor-not-allowed">
                                    Approved
                                </button>
                            @endif
                            
                            <form action="{{ route('delete-registration', $drt->id) }}" method="POST" 
                                  onsubmit="return confirmDelete(event, '{{ $drt->name }}')" class="m-0">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="p-2 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 transition-colors">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Proof Modal -->
<div id="proofModal" class="fixed inset-0 bg-black/80 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-2xl w-auto mx-auto">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold">Payment Proof</h3>
            <button onclick="closeProofModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-4">
            <img id="proofImage" src="" alt="Payment Proof" class="w-[300px] h-auto rounded">
        </div>
    </div>
</div>
    </main>

    <script>
        // Proof Modal Functions
        function showProofModal(imageSrc) {
            document.getElementById('proofImage').src = imageSrc;
            document.getElementById('proofModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeProofModal() {
            document.getElementById('proofModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Approve Payment Function with SweetAlert2
        async function approvePayment(registrationId, userName, userEmail) {
            // SweetAlert Confirmation
            const result = await Swal.fire({
                title: 'Approve Payment?',
                html: `Approve payment for <strong>${userName}</strong>?<br>This will activate their membership and send confirmation email.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Approve!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            });

            if (!result.isConfirmed) {
                return;
            }

            // Show loading
            Swal.fire({
                title: 'Processing...',
                text: 'Approving payment and sending email...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                const response = await fetch('{{ route("approve-registration") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        registration_id: registrationId,
                        user_email: userEmail,
                        user_name: userName
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Success SweetAlert
                    await Swal.fire({
                        title: 'Success!',
                        html: `Payment approved successfully!<br>Email confirmation sent to <strong>${userName}</strong>.`,
                        icon: 'success',
                        confirmButtonColor: '#10b981',
                        confirmButtonText: 'OK'
                    });
                    
                    // Reload page
                    window.location.reload();
                } else {
                    throw new Error(data.message || 'Approval failed');
                }

            } catch (error) {
                console.error('Approve error:', error);
                
                // Error SweetAlert
                await Swal.fire({
                    title: 'Error!',
                    text: error.message,
                    icon: 'error',
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK'
                });
            }
        }

        // Confirm Delete Function with SweetAlert2
        function confirmDelete(event, userName) {
            event.preventDefault();
            
            Swal.fire({
                title: 'Delete Registration?',
                html: `Delete registration for <strong>${userName}</strong>?<br>This action cannot be undone and rejection email will be sent.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading while processing
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Deleting registration and sending email...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit the form
                    event.target.submit();
                }
            });
            
            return false;
        }

        // SweetAlert for form submission feedback (if needed)
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#10b981'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#ef4444'
            });
        @endif
    </script>
@endsection