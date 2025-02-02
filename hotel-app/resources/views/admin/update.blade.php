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
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            <h2 class="text-2xl font-bold text-white text-center mb-6">Update Room</h2>
            
            <form action="{{ route('room.update', ['id' => $room->id]) }}" method="POST">
    @csrf
    @method('POST') 
             <form>
    <input type="hidden" id="roomId" value="{{ $room->id }}"> 

    <!-- Room Type -->
    <div class="mb-4">
    <label for="roomType" class="block text-sm font-medium text-gray-300 mb-2">Room Type</label>
    <select 
        id="roomType" 
        class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">Select Room Type</option>
        @foreach($roomTypes as $type)
            <option value="{{ $type->room_type }}" {{ $type->room_type == $room->room_type ? 'selected' : '' }}>
                {{ ucfirst($type->room_type) }}
            </option>
        @endforeach
    </select>
</div>


    <!-- Room Details -->
    <div class="mb-4">
        <label for="roomDetails" class="block text-sm font-medium text-gray-300 mb-2">Room Description</label>
        <textarea 
            id="roomDetails" 
            rows="3" 
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Enter room description...">{{ $room->description }}</textarea>
    </div>

    <!-- Price -->
    <div class="mb-4">
        <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Price (in USD)</label>
        <input 
            type="number" 
            id="price" 
            value="{{ $room->price }}"
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
            placeholder="Enter price">
    </div>

    <!-- Availability -->
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label for="availableFrom" class="block text-sm font-medium text-gray-300 mb-2">Available From</label>
            <input 
                type="date" 
                id="availableFrom" 
                value="{{ $room->available_from }}" 
                class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="availableTo" class="block text-sm font-medium text-gray-300 mb-2">Available To</label>
            <input 
                type="date" 
                id="availableTo" 
                value="{{ $room->available_to }}" 
                class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>

    <!-- Available Rooms -->
    <div class="mb-4">
        <label for="availableRooms" class="block text-sm font-medium text-gray-300 mb-2">Available Rooms</label>
        <input 
            type="number" 
            id="availableRooms" 
            value="{{ $room->available_rooms }}" 
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
            placeholder="Enter number of available rooms">
    </div>

    <!-- Free Pickup -->
    <div class="mb-4">
        <label for="freePickup" class="block text-sm font-medium text-gray-300 mb-2">Free Pickup</label>
        <select 
            id="freePickup" 
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="1" {{ $room->free_pickup ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$room->free_pickup ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <!-- Air Condition -->
    <div class="mb-4">
        <label for="airCondition" class="block text-sm font-medium text-gray-300 mb-2">Air Condition</label>
        <select 
            id="airCondition" 
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="1" {{ $room->is_ac ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$room->is_ac ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <!-- Is Recommended -->
    <div class="mb-4">
        <label for="isRecommended" class="block text-sm font-medium text-gray-300 mb-2">Is Recommended</label>
        <select 
            id="isRecommended" 
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="1" {{ $room->is_recommended ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$room->is_recommended ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <!-- Upload Picture -->
    <div class="mb-4">
        <label for="roomPicture" class="block text-sm font-medium text-gray-300 mb-2">Upload Picture</label>
        <input 
            type="file" 
            id="roomPicture" 
            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Submit Buttons -->
    <div class="mt-6 flex justify-between">
        <button 
            type="button" 
            class="update-room-button w-1/2 bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-400 mr-2">
            Update Room
        </button>
        <button 
            type="button" 
            class="delete-room-button w-1/2 bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-500 focus:outline-none focus:ring-4 focus:ring-red-400 ml-2"
            data-room-id="{{$room->id}}">
            Delete Room
        </button>
    </div>
</form>

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
       document.querySelector('.update-room-button').addEventListener('click', function () {
    const roomId = document.getElementById('roomId').value;
    const roomType = document.getElementById('roomType').value;
    const roomDetails = document.getElementById('roomDetails').value;
    const price = document.getElementById('price').value;
    const availableFrom = document.getElementById('availableFrom').value;
    const availableTo = document.getElementById('availableTo').value;
    const availableRooms = document.getElementById('availableRooms').value;

    const formData = new FormData();
    formData.append('room_type', roomType);
    formData.append('description', roomDetails);
    formData.append('price', price);
    formData.append('available_from', availableFrom);
    formData.append('available_to', availableTo);
    formData.append('available_rooms', availableRooms);
    formData.append('free_pickup', document.getElementById('freePickup').value);
    formData.append('is_ac', document.getElementById('airCondition').value);
    formData.append('is_recommended', document.getElementById('isRecommended').value);
    formData.append('roomPicture', document.getElementById('roomPicture').files[0]);

    fetch(`/rooms/update/${roomId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: formData,
    })
    .then((response) => response.json())
.then((data) => {
    if (data.message) { // Check if the message exists in the response
        alert(data.message); // Display the success message
        window.location.href = '/adminview'; // Redirect to the admin view page
    }
})
.catch((error) => console.error('Error:', error));

});

document.querySelectorAll('.delete-room-button').forEach(button => {
        button.addEventListener('click', function () {
            const roomId = this.getAttribute('data-room-id'); 
            // const roomId = this.dataset.roomId; // Get room ID from the data attribute

            if (confirm('Are you sure you want to delete this room?')) {
                fetch(`/admin/rooms/${roomId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Show success message
                    window.location.href ='/adminview'; // Reload the page to reflect changes
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });


        // Sidebar toggle functionality
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });

    </script>
</body>
</html>
