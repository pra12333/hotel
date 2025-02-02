<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Room List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <main class="flex-grow p-6">
        <h2 class="text-2xl font-bold text-white mb-6">Room List</h2>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md overflow-x-auto">
    <table class="table-auto w-full border-collapse border border-gray-700">
        <thead>
            <tr class="bg-blue-900 text-white">
                <th class="px-4 py-2 text-left border border-gray-700">Room Type</th>
                <th class="px-4 py-2 text-left border border-gray-700">Description</th>
                <th class="px-4 py-2 text-left border border-gray-700">Price</th>
                <th class="px-4 py-2 text-left border border-gray-700">Available From</th>
                <th class="px-4 py-2 text-left border border-gray-700">Available To</th>
                <th class="px-4 py-2 text-left border border-gray-700">Available Rooms</th>
                <th class="px-4 py-2 text-left border border-gray-700">Free Pickup</th>
                <th class="px-4 py-2 text-left border border-gray-700">Air Condition</th>
                <th class="px-4 py-2 text-left border border-gray-700">Is Recommended</th>
                <th class="px-4 py-2 text-left border border-gray-700">Image</th>
                <th class="px-4 py-2 text-center border border-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr class="bg-gray-900 hover:bg-gray-700 text-gray-300">
                <td class="px-4 py-2 border border-gray-700">{{ $room->room_type }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $room->description }}</td>
                <td class="px-4 py-2 border border-gray-700">${{ number_format($room->price, 2) }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $room->available_from }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $room->available_to }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $room->available_rooms }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $room->free_pickup ? 'Yes' : 'No' }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $room->is_ac ? 'Yes' : 'No' }}</td>
                <td class="px-4 py-2 border border-gray-700">{{ $room->is_recommended ? 'Yes' : 'No' }}</td>
                <td class="px-4 py-2 border border-gray-700">
                <img src="{{ asset('storage/' . (Str::startsWith($room->image, 'images/') ? $room->image : 'images/' . $room->image)) }}" alt="Room Image" class="w-12 h-12 object-cover rounded">
                </td>
                <td class="px-4 py-2 border border-gray-700 text-center">
    <div class="flex justify-center space-x-2">
        <!-- View Button -->
        <a href="{{ route('rooms.show', $room->id) }}" 
           class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-400">
            View
        </a>

        <!-- Update Button -->
        <a href="{{ route('rooms.edit', $room->id) }}" 
           class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-400">
            Update
        </a>

        <!-- Delete Button -->
        <button 
            type="button" 
            data-room-id="{{ $room->id }}" 
            class="delete-room-button bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-400">
            Delete
        </button>
    </div>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
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

    <script>
        // Modal Functions
function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
        document.querySelectorAll('.delete-room-button').forEach(button => {
        button.addEventListener('click', function () {
            const roomId = this.dataset.roomId; // Get room ID from the data attribute

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
                    location.reload(); // Reload the page to reflect changes
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
