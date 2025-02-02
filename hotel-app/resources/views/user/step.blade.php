<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Rooms - E Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <a href="#" class="hover:text-blue-300">Home</a>
                <a href="{{route('search')}}" class="hover:text-blue-300">Search</a>
                <a href="{{route('rooms.list')}}" class="hover:text-blue-300">Rooms</a>
                <a href="{{route('profile')}}" class="hover:text-blue-300">Settings</a>
                <form action= "{{route('logout') }}" method="POST">
                    @csrf 
                    <button type="button" onclick="showLogoutModal()" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
    Logout
</button>
</form>
            </div>
        </div>
    </nav>

    <section class="container mx-auto py-10">
    <h1 class="text-4xl font-extrabold text-gray-800 text-center mb-8">Complete Your Booking</h1>
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <!-- Room Details -->
        <div class="mb-6">
            <img src="{{ asset('storage/images/' . $room->image) }}" alt="Room Image" class="w-full h-48 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-bold text-gray-800">{{ $room->room_type }}</h2>
            <p class="text-gray-600">{{ $room->description }}</p>
            <p class="text-gray-600 mt-2"><span class="font-bold">Price:</span> ${{ $room->price }}/night</p>
        </div>

        <!-- Booking Form -->
        <form action="{{ route('payment') }}" method="GET">
    @csrf
    <input type="hidden" name="room_id" value="{{ $room->id }}">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="flex flex-col">
            <label for="check_in" class="text-gray-600 font-bold mb-2">Check-in Date</label>
            <input 
                type="date" 
                id="check_in" 
                name="check_in" 
                value="{{$checkIn ?? ''}}"
                required 
                class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div class="flex flex-col">
            <label for="check_out" class="text-gray-600 font-bold mb-2">Check-out Date</label>
            <input 
                type="date" 
                id="check_out" 
                name="check_out" 
                value="{{$checkOut ?? ''}}"
                required 
                class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div class="flex flex-col">
            <label for="adults" class="text-gray-600 font-bold mb-2">Number of Adults</label>
            <input 
                type="number" 
                id="adults" 
                name="adults" 
                min="1" 
                required 
                class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div class="flex flex-col">
            <label for="children" class="text-gray-600 font-bold mb-2">Number of Children</label>
            <input 
                type="number" 
                id="children" 
                name="children" 
                min="0" 
                class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>
    </div>

    <div class="flex flex-col mt-4">
        <label for="total_price" class="text-gray-600 font-bold mb-2">Total Price</label>
        <input 
            type="text" 
            id="total_price" 
            name="total_price" 
            value="{{ $room->price }}" 
            readonly 
            class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>

    <!-- Submit Button -->
    <div class="mt-6">
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-lg shadow font-bold">
            Proceed to Payment
        </button>
    </div>
</form>

    </div>
</section>
  
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
    <script>
     

 // Modal Functions
    function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
      
    document.addEventListener('DOMContentLoaded', function () {
        // Get DOM elements
        const basePrice = {{ $room->price }};
        const adultsInput = document.getElementById('adults');
        const childrenInput = document.getElementById('children');
        const totalPriceInput = document.getElementById('total_price');

        // Function to calculate total price
        function updateTotalPrice() {
            const numAdults = parseInt(adultsInput.value) || 0;
            const numChildren = parseInt(childrenInput.value) || 0;

            // Additional charges per adult and child
            const adultCharge = 50; // Customize as needed
            const childCharge = 25; // Customize as needed

            // Calculate total price
            const totalPrice = basePrice + (numAdults * adultCharge) + (numChildren * childCharge);

            // Update total price field
            totalPriceInput.value = `$${totalPrice.toFixed(2)}`;
        }

        // Attach event listeners to input fields
        adultsInput.addEventListener('input', updateTotalPrice);
        childrenInput.addEventListener('input', updateTotalPrice);
    });


        </script>
</body>
</html>
