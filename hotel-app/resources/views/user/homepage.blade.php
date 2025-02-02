<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage - E Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-blue-900 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">
            <a href="#">
            <img src="{{ asset('storage/images/royal.jpg') }}" alt="E Hotel Logo" class="h-12">
        </a>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{route('homepage')}}" class="hover:text-blue-300">Home</a>
                   <!-- Show Dashboard Button ONLY for Admin -->
                   @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin') }}" class="hover:text-blue-300">
                        Dashboard
                    </a>
                @endif
                <a href="{{route('search')}}" class="hover:text-blue-300">Search</a>
                <a href="{{route('rooms.list')}}" class="hover:text-blue-300">Rooms</a>
                <a href="{{route('profile')}}" class="hover:text-blue-300">Settings</a>
                <!-- <a href="#" class="hover:text-blue-300">Contact</a> -->
                <form action= "{{route('logout') }}" method="POST">
                    @csrf 
                    <button type="button" onclick="showLogoutModal()" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
    Logout
</button>
</form>
                <!-- Profile Picture -->
                <!-- <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden">
                    <img src="{{ asset('storage/images/profile.jpg') }}" alt="Profile Picture" class="w-full h-full object-cover">
                </div> -->
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative bg-cover bg-center h-[60vh]" style="background-image: url('{{ asset('storage/images/roombanner.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col items-center justify-center">
            <div class="text-center text-white mb-6">
                <h1 class="text-5xl font-extrabold mb-4">Welcome to E Hotel</h1>
                <p class="text-xl mb-6">Luxury Living for Your Comfort</p>
                <a href="{{route('rooms.list')}}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg">Book a Room</a>
            </div>
          
        </div>
    </header>
   

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="container mx-auto py-10 space-y-10">
            <!-- Welcome Message -->
            <div class="text-center">
            @php
    $hour = now()->format('H'); // Get the hour in 24-hour format
    if ($hour >= 5 && $hour < 12) {
        $greeting = 'Good Morning';
    } elseif ($hour >= 12 && $hour < 17) {
        $greeting = 'Good Afternoon';
    } elseif ($hour >= 17 && $hour < 21) {
        $greeting = 'Good Evening';
    } else {
        $greeting = 'Good Night';
    }
@endphp

<h2 class="text-4xl font-extrabold text-gray-800">
    {{ $greeting }}, {{ Auth::user()?->name ?? 'Guest' }}!
</h2>
<p class="text-gray-600 mt-2">Here’s your personalized dashboard</p>

 <!-- Search Bar -->
 <form id="searchRoomsForm" class="w-full max-w-lg mt-4">
    <div class="relative mb-4">
        <input 
            type="text" 
            name="room_type" 
            id="roomType" 
            placeholder="Enter Room Type (e.g., Deluxe Room)" 
            class="w-full py-3 px-6 rounded-full text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>
    <div class="flex space-x-4 mb-4">
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="ac" id="ac" value="1" class="form-checkbox">
            <span>AC</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="pickup" id="pickup" value="1" class="form-checkbox">
            <span>Pickup</span>
        </label>
    </div>
    <div class="flex space-x-4 mb-4">
        <input 
            type="number" 
            name="price_min" 
            id="priceMin" 
            placeholder="Min Price" 
            class="w-1/2 py-3 px-4 rounded-full text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
        <input 
            type="number" 
            name="price_max" 
            id="priceMax" 
            placeholder="Max Price" 
            class="w-1/2 py-3 px-4 rounded-full text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>
    <button 
        type="button" 
        id="searchButton" 
        class="w-full bg-blue-500 text-white py-3 px-4 rounded-full hover:bg-blue-600 focus:outline-none">
        Search
    </button>
</form>
<div id="searchResults" class="mt-6 container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    <!-- Results will be dynamically loaded here -->
</div>
            <!-- Payment Status -->
            <section class="mb-10">
    <h3 class="text-3xl font-bold text-gray-800 mb-6">Payment Status</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($pendingBookings as $booking)
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col md:flex-row items-center">
                <img src="{{ asset('storage/images/room1.jpg') }}" alt="{{ $booking->room->name }}" class="w-32 h-32 object-cover rounded-lg mb-4 md:mb-0 md:mr-6">
                <div>
                    <h4 class="text-xl font-bold text-gray-800">{{ $booking->room->name }}</h4>
                    <p class="text-gray-600">Status: <span class="text-yellow-500 font-bold">Pending</span></p>
                    <p class="text-gray-600 mt-2">Price: <span class="text-green-500 font-bold">${{ $booking->total_price }}</span></p>
                    <p class="text-gray-500 text-sm mt-2">Booking ID: #{{ $booking->id }}</p>
                    <p class="text-red-500 text-sm mt-2">Payment Deadline: 
                        <span class="font-bold">
                            {{ $booking->expires_at ? $booking->expires_at->format('Y-m-d H:i A') : 'N/A' }}
                        </span>
                    </p>
                    <p class="text-blue-500 text-sm mt-2" id="countdown-{{ $booking->id }}"></p>
                    <!-- Continue Payment Button -->
                    <div class="mt-4">
                        <a href="{{ route('payment.continue', ['bookingId' => $booking->id]) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg shadow font-bold">
                            Continue Payment
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-600">You have no pending payments.</p>
        @endforelse
    </div>
</section>




            <!-- Past Bookings -->
            <section class="mb-10">
    <h3 class="text-3xl font-bold text-gray-800 mb-6">Past Bookings</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($pastBookings as $booking)
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col md:flex-row items-center">
                <img src="{{ asset('storage/images/room1.jpg') }}" alt="{{ $booking->room->name }}" class="w-32 h-32 object-cover rounded-lg mb-4 md:mb-0 md:mr-6">
                <div>
                    <h4 class="text-xl font-bold text-gray-800">{{ $booking->room->name }}</h4>
                    <p class="text-gray-600">Stayed: {{ $booking->check_in }} to {{ $booking->check_out }}</p>
                    <p class="text-gray-500 text-sm mt-2">Total Cost: ${{ $booking->total_price }}</p>
                    <button onclick="window.location.href='{{ route('review',['roomId' => $booking->room_id]) }}'" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                        Place a Review
                    </button>
                    
                    {{-- Check for canceled bookings only if a booking exists --}}
                    @if ($booking->canceled_at)
                        <p class="text-red-500 font-bold">Canceled on: {{ $booking->canceled_at->format('Y-m-d H:i') }}</p>
                        <p class="text-green-500">Refund Status: {{ ucfirst($booking->refund_status) }}</p>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-600">You have no past bookings.</p>
        @endforelse
    </div>
</section>

            <!-- Recommendations -->
            <section class="mb-10">
    <h3 class="text-3xl font-bold text-gray-800 mb-6 text-center">Recommended For You</h3>
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($recommendedRooms as $room)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                <img src="{{ asset('storage/images/' . $room->image) }}" alt="{{ $room->name }}" class="w-full h-40 object-cover">
                <div class="p-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-2">{{ $room->name }}</h4>
                    <p class="text-gray-600 mb-4 text-sm line-clamp-2">{{ $room->description }}</p>
                    <a href="{{ route('room.details', ['room_id' => $room->id]) }}" 
   class="block bg-blue-500 text-center text-white py-2 rounded hover:bg-blue-600 transition duration-300">
   View Details
</a>
                </div>
            </div>
        @endforeach
    </div>
</section>


 <!-- Notifications and Reminders -->
 <section class="bg-blue-50 py-8 px-6 rounded-lg">
    <h3 class="text-3xl font-bold text-gray-800 mb-4">Notifications & Reminders</h3>
    <ul id="notificationsList" class="space-y-4">
        @forelse ($notifications as $notification)
            <li class="bg-white p-4 rounded-lg shadow-lg">
                <p class="text-gray-800">{{ $notification->message }}</p>
                <p class="text-gray-500 text-sm">{{ $notification->created_at->format('M d, Y h:i A') }}</p>
                <!-- Mark as Read Button -->
                <button 
                    class="mark-as-read bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 mt-2"
                    data-id="{{ $notification->id }}"
                >
                    Mark as Read
                </button>
            </li>
        @empty
            <li class="text-gray-500">No new notifications.</li>
        @endforelse
    </ul>
</section>

           <!-- Recent Activities -->
<section class="bg-blue-50 py-10 px-6 rounded-lg shadow-md max-w-6xl mx-auto">
    <h3 class="text-3xl font-bold text-gray-800 mb-8 text-center">Recent Activities</h3>
    <div class="space-y-6">
        @forelse ($recentActivities as $activity)
            <!-- Activity Card -->
            <div class="flex items-center bg-white p-5 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <!-- Icon -->
                <div class="flex-shrink-0 bg-green-100 text-green-500 p-3 rounded-full">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 2H7m3-6h4m-5 6h6m2 4a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <!-- Content -->
                <div class="ml-4">
                    <p class="text-gray-800 font-semibold">{{ $activity->description }}</p>
                    <p class="text-gray-500 text-sm mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            <p class="text-gray-600 text-center">No recent activities.</p>
        @endforelse
    </div>
</section>

        </div>
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
    <footer class="bg-gray-900 text-gray-300 py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 E Hotel. All Rights Reserved.</p>
        </div>
    </footer>
    <!-- Countdown Script -->
<script>
    const pendingBookings = @json($pendingBookings);

pendingBookings.forEach(booking => {
    const countdownElement = document.getElementById(`countdown-${booking.id}`);
    const deadline = new Date(booking.expires_at).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = deadline - now;

        if (distance > 0) {
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElement.textContent = `Time left: ${days}d ${hours}h ${minutes}m ${seconds}s`;
        } else {
            countdownElement.textContent = "Payment deadline has passed.";
        }

        if (distance <= 0) {
            countdownElement.textContent = "Payment deadline has passed.";
            countdownElement.closest('.bg-white').remove(); // remove the expired card
        }
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});
// Modal Functions
function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }


        document.getElementById('searchButton').addEventListener('click', function () {
        const roomType = document.getElementById('roomType').value;
        const ac = document.getElementById('ac').checked ? 1 : 0;
        const pickup = document.getElementById('pickup').checked ? 1 : 0;
        const priceMin = document.getElementById('priceMin').value;
        const priceMax = document.getElementById('priceMax').value;

        // Send AJAX request
        fetch('{{route('homepage.search')}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                room_type: roomType,
                ac: ac,
                pickup: pickup,
                price_min: priceMin,
                price_max: priceMax,
            }),
        })
        .then(response => response.json())
        .then(data => {
            const resultsContainer = document.getElementById('searchResults');
            resultsContainer.innerHTML = ''; // Clear previous results
            if (data.success && data.data.length > 0) {
    data.data.forEach(room => {
        const roomCard = `
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                <img src="/storage/images/${room.image}" alt="${room.room_type}" class="w-full h-40 object-cover">
                <div class="p-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-2">${room.room_type}</h4>
                    <p class="text-gray-600 mb-4 text-sm">${room.description}</p>
                    <p class="text-gray-600 font-bold">Price: $${room.price}</p>
                   <a href="{{ route('room.details', ['room_id' => $room->id]) }}" class="block bg-blue-500 text-center text-white py-2 rounded hover:bg-blue-600 transition duration-300">
                        View Details
                    </a>
                </div>
            </div>
        `;
        resultsContainer.innerHTML += roomCard;
    });
} else {
    resultsContainer.innerHTML = '<p class="text-gray-600 text-center">No rooms found.</p>';
}

            
        })
        .catch(error => console.error('Error:', error));
    });

    document.addEventListener('DOMContentLoaded', function () {
    const notificationsContainer = document.querySelector('#notificationsList');

    // Fetch notifications
    function fetchNotifications() {
        console.log('Fetching notifications...');
        fetch('/homepage-notifications', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
            .then(response => response.json())
            .then(data => {
                console.log('Fetched Notifications:', data.notifications);
                notificationsContainer.innerHTML = ''; // Clear existing notifications

                if (data.notifications.length > 0) {
                    data.notifications.forEach(notification => {
                        const notificationItem = `
                            <li class="bg-white p-4 rounded-lg shadow-lg">
                            <p class="text-gray-800">${notification.message}</p>
                            <p class="text-gray-500 text-sm">${new Date(notification.created_at).toLocaleString()}</p>
                            <button 
                                class="mark-as-read bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 mt-2"
                                data-id="${notification.id}"
                            >
                                Mark as Read
                            </button>
                        </li>
                    `;
                        notificationsContainer.innerHTML += notificationItem;
                    });
                } else {
                    notificationsContainer.innerHTML = `
                        <li class="text-gray-500">No new notifications.</li>
                    `;
                }
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Fetch notifications on page load
    fetchNotifications();
});

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('mark-as-read')) {
        console.log('Mark as Read clicked for ID:', event.target.dataset.id);

        const reminderId = event.target.dataset.id;

        fetch(`/reminders/${reminderId}/mark-as-read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the reminder from the frontend
                    event.target.closest('li').remove();
                    console.log('Reminder marked as read and removed from UI.');
                } else {
                    console.error('Failed to mark reminder as read:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }
});

</script>

</body>
</html>
