<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Listing</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-blue-900 text-white">
    <div class="container mx-auto flex justify-between items-center py-4">
        <div class="text-2xl font-bold">
            <a href="#">
                <img src="{{ asset('storage/images/royal.jpg') }}" alt="E Hotel Logo" class="h-12">
            </a>
        </div>
        <ul class="flex space-x-6 items-center">
    <li><a href="{{route('homepage')}}" class="hover:text-blue-300">Home</a></li>
    <li><a href="{{route('search')}}" class="hover:text-blue-300">Search</a></li>
    <li><a href="{{route('rooms.list')}}" class="hover:text-blue-300">Rooms</a></li>
    <li><a href="{{route('profile')}}" class="hover:text-blue-300">Settings</a></li>
    <li>
        <form action="{{route('logout')}}" method="POST">
            @csrf 
            <button type="button" onclick="showLogoutModal()" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </li>
</ul>
    </div>
</nav>

<div class="container mx-auto py-10">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img src="{{ asset('storage/images/' . $room->image) }}" alt="{{ $room->name }}" class="w-full h-64 object-cover">
        <div class="p-6">
            <h1 class="text-4xl font-bold text-gray-800">{{ $room->name }}</h1>
            <p class="text-gray-600 mt-4">{{ $room->description }}</p>
            <p class="text-gray-600 mt-4">Price per Night: <span class="text-green-500 font-bold">${{ $room->price }}</span></p>
            <p class="text-gray-600 mt-4">Available Rooms: <span class="text-green-500 font-bold">{{ $room->available_rooms }}</span></p>
        </div>
    </div>

    <!-- Booking Form -->
    <div class="bg-white shadow-lg rounded-lg mt-6 p-6 max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Book Your Stay</h2>
        <form action="{{ route('payment') }}" method="GET" class="space-y-6">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">

            <div>
                <label for="check_in" class="block text-lg font-medium text-gray-700">Check-In Date</label>
                <input 
                    type="date" 
                    name="check_in" 
                    id="check_in" 
                    class="mt-2 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                    required>
            </div>

            <div>
                <label for="check_out" class="block text-lg font-medium text-gray-700">Check-Out Date</label>
                <input 
                    type="date" 
                    name="check_out" 
                    id="check_out" 
                    class="mt-2 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                    required>
            </div>

            <div>
                <label for="adults" class="block text-lg font-medium text-gray-700">Number of Adults</label>
                <input 
                    type="number" 
                    name="adults" 
                    id="adults" 
                    class="mt-2 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                    min="1" 
                    required>
            </div>

            <div>
                <label for="children" class="block text-lg font-medium text-gray-700">Number of Children</label>
                <input 
                    type="number" 
                    name="children" 
                    id="children" 
                    class="mt-2 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                    min="0">
            </div>

            <button 
                type="submit" 
                class="w-full bg-blue-500 hover:bg-blue-600 text-white text-lg font-semibold py-3 rounded-lg shadow-md transition duration-300">
                Book Now
            </button>
        </form>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-300 py-8 mt-10">
    <div class="container mx-auto text-center space-y-4">
       
        <p class="text-gray-400">&copy; 2024 E Hotel. All Rights Reserved.</p>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get today's date in 'YYYY-MM-DD' format
        const today = new Date().toISOString().split('T')[0];

        // Set the min attribute and default value for the Check-In Date
        const checkInField = document.getElementById('check_in');
        if (checkInField) {
            checkInField.setAttribute('min', today); // Set minimum date to today
            checkInField.value = today; // Set default value to today
        }

        // Optionally, ensure the Check-Out Date is after Check-In Date
        const checkOutField = document.getElementById('check_out');
        if (checkOutField) {
            checkOutField.setAttribute('min', today); // Set minimum date to today
            checkInField.addEventListener('change', function () {
                const checkInDate = this.value;
                checkOutField.setAttribute('min', checkInDate); // Ensure Check-Out is after Check-In
            });
        }
    });
</script>

</body>
</html>
