<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
   
    <style>
        /* Sidebar toggler styles */
        #sidebar {
            transition: all 0.3s ease-in-out;
        }

        #sidebar.collapsed {
            width: 80px;
        }

        #sidebar.collapsed .sidebar-item span {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Sidebar -->
    <nav id="sidebar" class="bg-blue-900 w-64 flex flex-col">
        <div class="flex items-center justify-between p-4">
            <h1 class="text-xl font-bold">Innap</h1>
            <button id="toggleSidebar" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
        </div>
        <ul class="space-y-2 mt-4 px-4">
        <li class="sidebar-item">
    <a href="{{ route('admin') }}" class="flex items-center p-2 hover:bg-blue-700 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
        </svg>
        <span>Dashboard</span>
    </a>
</li>
            <li class="sidebar-item">
    <a href="{{ route('homepage') }}" class="flex items-center p-2 hover:bg-blue-700 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m4 4H5m7-8v12m2-8v12"/>
        </svg>
        <span>Homepage</span>
    </a>
</li>
            <li class="sidebar-item">
    <a href="{{ route('rooms.list') }}" class="flex items-center p-2 hover:bg-blue-700 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m4 4H5m7-8v12m2-8v12"/>
        </svg>
        <span>Rooms</span>
    </a>
</li>
<li class="sidebar-item">
    <a href="{{ route('room-register') }}" class="flex items-center p-2 hover:bg-blue-700 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m4 4H5m7-8v12m2-8v12"/>
        </svg>
        <span>Add Room</span>
    </a>
</li>
<li class="sidebar-item">
    <a href="{{ route('view') }}" class="flex items-center p-2 hover:bg-blue-700 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m4 4H5m7-8v12m2-8v12"/>
        </svg>
        <span>Registered Rooms</span>
    </a>
</li>

            <li class="sidebar-item flex items-center p-2 hover:bg-blue-700 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16M4 8h16M4 12h16M4 16h16"/>
                </svg>
                <span>Reports</span>
            </li>
        </ul>
    </nav>
    
    <!-- Top Navigation Bar -->
<div class="absolute top-0 right-0 p-4">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="button" onclick="showLogoutModal()" 
            class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
            Logout
        </button>
    </form>
</div>


    <!-- Main Content -->
    <main class="flex-grow p-6 flex justify-center items-center">
        <!-- Room Registration Form -->
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-2xl font-bold text-white text-center mb-6">Register a Room</h2>
            <div id="messageContainer" class="mb-4"></div>

            @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Room Type -->
    <div class="mb-4">
    <label for="roomType" class="block text-sm font-medium text-gray-300 mb-2">Room Type</label>
    <select 
        id="roomType" 
        name="room_type"
        class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">Select Room Type</option>
        @foreach($roomTypes as $type)
            <option value="{{ $type->room_type }}">{{ ucfirst($type->room_type) }}</option>
        @endforeach
    </select>
    @error('room_type')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


    <!-- Description -->
    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
        <textarea 
            id="description" 
            name="description"
            rows="3" 
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Enter a brief description of the room"></textarea>
    </div>

    <!-- Price -->
    <div class="mb-4">
        <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Price (in USD)</label>
        <input 
            type="number" 
            id="price" 
            name="price"
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
            placeholder="Enter price">
    </div>

    <!-- Available From -->
    <div class="mb-4">
        <label for="availableFrom" class="block text-sm font-medium text-gray-300 mb-2">Available From</label>
        <input 
            type="date" 
            id="availableFrom" 
            name="available_from"
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Available To -->
    <div class="mb-4">
        <label for="availableTo" class="block text-sm font-medium text-gray-300 mb-2">Available To</label>
        <input 
            type="date" 
            id="availableTo" 
            name="available_to"
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Available Rooms -->
    <div class="mb-4">
        <label for="availableRooms" class="block text-sm font-medium text-gray-300 mb-2">Available Rooms</label>
        <input 
            type="number" 
            id="availableRooms" 
            name="available_rooms"
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
            placeholder="Enter number of available rooms">
    </div>

    <!-- Free Pickup -->
    <div class="mb-4">
        <label for="freePickup" class="block text-sm font-medium text-gray-300 mb-2">Free Pickup</label>
        <select 
            id="freePickup" 
            name="free_pickup"
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Select Free Pickup</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
    </div>

    <!-- AC Available -->
    <div class="mb-4">
        <label for="isAc" class="block text-sm font-medium text-gray-300 mb-2">Air Conditioning</label>
        <select 
            id="isAc" 
            name="is_ac"
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Select AC Availability</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
    </div>

    <!-- Is Recommended -->
    <div class="mb-4">
        <label for="isRecommended" class="block text-sm font-medium text-gray-300 mb-2">Is Recommended</label>
        <select 
            id="isRecommended" 
            name="is_recommended"
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Select Recommendation</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
    </div>

    <!-- Upload Picture -->
    <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Upload Picture</label>
        <input 
            type="file" 
            id="image" 
            name="image"
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Submit Button -->
    <div class="mt-6">
        <button 
            type="submit" 
            class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-400">
            Register Room
        </button>
    </div>
</form>

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

    <script>
        // Modal Functions
function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        // Sidebar toggle functionality
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
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
