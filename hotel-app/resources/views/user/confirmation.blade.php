<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - E Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{csrf_token() }}">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-blue-900 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">
                <a href="#" class="hover:text-blue-300">E Hotel</a>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{route('homepage')}}" class="hover:text-blue-300">Home</a>
                <a href="#" class="hover:text-blue-300">Bookings</a>
                <a href="#" class="hover:text-blue-300">Contact</a>
                <form action= "{{route('logout') }}" method="POST">
                    @csrf 
                    <button type="button" onclick="showLogoutModal()" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
    Logout
</button>
</form>
            </div>
        </div>
    </nav>
    @if(session('success'))
    <div id="successAlert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="closeAlert()">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M14.348 14.849a1 1 0 01-1.415 0L10 11.414l-2.933 3.435a1 1 0 01-1.414-1.415l3.435-2.933-3.435-2.933a1 1 0 011.415-1.415L10 8.586l3.435-2.933a1 1 0 011.414 1.415l-2.933 3.435 2.933 3.435a1 1 0 010 1.415z"/>
            </svg>
        </span>
    </div>
    @endif
  <!-- Booking Details Section -->
<main class="container mx-auto py-10">
    <h1 class="text-4xl font-extrabold text-gray-800 text-center mb-8">Booking Confirmation</h1>

    @if(isset($booking))
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto">
        <!-- Booking Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Image Section -->
            <div class="flex justify-center items-center">
                <img 
                    src="{{ asset('storage/images/' . $booking->room->image) }}" 
                    alt="Room Image" 
                    class="w-full aspect-w-4 aspect-h-3 object-cover rounded-lg"
                />
            </div>
            <!-- Details Section -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Booking Summary</h2>
                <p class="text-gray-600"><strong>Room Type:</strong> {{ $booking->room->room_type }}</p>
                <p class="text-gray-600"><strong>Check-in:</strong> {{ $booking->check_in }}</p>
                <p class="text-gray-600"><strong>Check-out:</strong> {{ $booking->check_out }}</p>
                <p class="text-gray-600"><strong>Guests:</strong> {{ $booking->adults }} Adults, {{ $booking->children }} Children</p>
                <p class="text-gray-600"><strong>Total Price:</strong> ${{ $booking->total_price }}</p>
                <p class="text-gray-600"><strong>Payment Status:</strong> {{ ucfirst($booking->payment_status) }}</p>
                <p class="text-gray-600"><strong>Reference Number:</strong> {{ $booking->reference_number }}</p>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Payment Status</h2>
            <div class="flex items-center space-x-4">
                <span class="text-green-500 font-bold text-xl">{{ ucfirst($booking->payment_status) }}</span>
                @if ($booking->payment_status === 'paid')
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                @endif
            </div>
            <p class="text-gray-600 mt-2"><strong>Reference Number:</strong> {{ $booking->reference_number }}</p>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-between">
            <a href="/modify-booking/{{ $booking->id }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-8 rounded-lg shadow font-bold">
                Modify Booking
            </a>
            @if ($booking->canceled_at)
    <!-- Disabled button for already canceled bookings -->
    <button class="bg-gray-400 text-white py-2 px-4 rounded cursor-not-allowed" disabled>
        Booking Canceled
    </button>
@else
    <!-- Active cancel button for uncanceled bookings -->
    <button type="button" class="cancel-booking-btn bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600" 
        data-booking-id="{{ $booking->id }}">
        Cancel Booking
    </button>
@endif


        </div>
    </div>
    @else
    <p class="text-red-500 text-center">No booking details available.</p>
    @endif
</main>
 <!-- Logout Confirmation Modal -->
 <div id="logoutModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-lg font-bold text-gray-800">Confirm Logout</h2>
        <p class="text-gray-600 mt-2">Are you sure you want to log out?</p>
        <div class="flex justify-end space-x-4 mt-4">
            <button onclick="closeLogoutModal()" class="bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400">
                Cancel
            </button>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                    Logout
                </button>

            </form>
        </div>
    </div>
</div>
   
    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-6 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 E Hotel. All Rights Reserved.</p>
        </div>
    </footer>
    <script>
         // Modal Functions
    function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        function closeAlert() {
            document.getElementById('successAlert').remove();
        }

        // Automatically close the alert after 5 seconds
        setTimeout(() => {
            const alert = document.getElementById('successAlert');
            if (alert) {
                alert.remove();
            }
        }, 5000);
        document.querySelectorAll('.cancel-booking-btn').forEach(button => {
    button.addEventListener('click', function () {
        const bookingId = this.dataset.bookingId;
        console.log(`Attempting to cancel booking with ID: ${bookingId}`);

        

        fetch(`/booking/cancel/${bookingId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Server Response:', data);
            if (data.success) {
                this.textContent = 'Booking Canceled';
                this.classList.remove('bg-red-500', 'hover:bg-red-600');
                this.classList.add('bg-gray-400', 'cursor-not-allowed');
                this.disabled = true;
                alert(data.message); // show success message
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

</script>
</body>
</html>
