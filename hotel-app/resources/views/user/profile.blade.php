<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - E Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <a href="{{route('search')}}" class="hover:text-blue-300">Search</a>
                <a href="{{route('rooms.list')}}" class="hover:text-blue-300">Rooms</a>
                <a href="{{route('profile')}}" class="hover:text-blue-300">Settings</a>
                <button 
                    type="button" 
                    onclick="showLogoutModal()" 
                    class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                    Logout
                </button>
            </div>
        </div>
    </nav>

    <!-- Profile Page Content -->
    <main class="container mx-auto py-10">
        <h1 class="text-4xl font-extrabold text-gray-800 text-center mb-8">My Profile</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Section: Profile Picture -->
            <section class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center">
                <img src="{{ asset('storage/images/face.jpg') }}" alt="Profile Picture" class="w-40 h-40 rounded-full object-cover mb-4">
                <form action="/update-profile-picture" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="block text-gray-600 font-bold mb-2">Update Profile Picture</label>
                    <input type="file" class="w-full text-gray-700 focus:outline-none mb-4" name="profile_picture" required>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg shadow font-bold">
                        Upload
                    </button>
                </form>
            </section>

            <!-- Middle Section: Personal Details -->
            <section class="md:col-span-2 bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Personal Information</h2>
                <form id="updateProfileForm">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="Full Name" class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email Address" class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}" placeholder="Phone Number" class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="flex justify-center mt-6">
                        <button 
                            type="button" 
                            onclick="updateProfile()" 
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg shadow font-bold">
                            Save Changes
                        </button>
                    </div>
                </form>
                <div id="successMessage" class="text-green-500 text-center mt-4 hidden">Changes saved successfully!</div>
            </section>
        </div>

        <!-- Loyalty Points and Saved Payment Methods -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
            <!-- Loyalty Points -->
            <section class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Loyalty Points</h2>
                <p class="text-gray-600">You have <span class="text-green-500 font-bold">1200 points</span>.</p>
                <p class="text-gray-500 text-sm">Redeem points for discounts on future bookings.</p>
            </section>

            <!-- Saved Payment Methods -->
            <section class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Saved Payment Methods</h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-center border rounded-lg p-4">
                        <div>
                            <p class="text-gray-800 font-bold">Visa</p>
                            <p class="text-gray-600 text-sm">**** **** **** 1234</p>
                        </div>
                        <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded-lg text-sm">Remove</button>
                    </div>
                    <div class="flex justify-between items-center border rounded-lg p-4">
                        <div>
                            <p class="text-gray-800 font-bold">MasterCard</p>
                            <p class="text-gray-600 text-sm">**** **** **** 5678</p>
                        </div>
                        <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded-lg text-sm">Remove</button>
                    </div>
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
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Logout</button>
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

    <!-- JavaScript -->
    <script>
        // Modal Functions
        function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        // Profile Update Function
        function updateProfile() {
            const formData = new FormData(document.getElementById("updateProfileForm"));
            fetch("{{ route('profile.update') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        document.getElementById("successMessage").classList.remove("hidden");
                        setTimeout(() => {
                            document.getElementById("successMessage").classList.add("hidden");
                        }, 3000);
                    } else {
                        alert("Failed to save changes: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error updating profile:", error);
                    alert("An error occurred. Please try again.");
                });
        }
    </script>
</body>
</html>
