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
    <!-- Hero Section -->
    <div class="relative h-[50vh] bg-cover bg-center" style="background-image: url('{{ asset('storage/images/roombanner.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <h1 class="text-white text-4xl font-bold">Our Rooms</h1>
             </div>
    </div>

    <!-- Room Grid Section -->
    <div class="container mx-auto py-10">
    <h2 class="text-3xl font-bold text-center mb-6">Choose Your Stay</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($rooms as $room)
            <!-- Room Card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img 
    src="{{ asset('storage/' . (Str::startsWith($room->image, 'images/') ? $room->image : 'images/' . $room->image)) }}" 
    alt="{{ $room->room_type }}" 
    class="w-full h-48 object-cover rounded-lg">
                <div class="p-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ $room->room_type }}</h3>
                    <p class="text-gray-600">{{ $room->description }}</p>
                    <a href="{{ route('room.details', ['room_id' => $room->id]) }}" 
   class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
   View Details
</a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $rooms->links() }}
    </div>
</div>
@if ($rooms->isEmpty())
    <p class="text-center text-gray-500">No rooms available at the moment. Please check back later.</p>
@endif

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
        <div class="text-center">
            &copy; 2024 eHotel. All Rights Reserved.
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


        </script>
</body>
</html>





<!-- <img src="{{ asset('storage/images/' . $room->image) }}" alt="{{ $room->name }}" class="w-full h-48 object-cover"> -->