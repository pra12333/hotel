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
   
            <ul class="flex space-x-6">
                <li><a href="#" class="hover:text-blue-300">Home</a></li>
                <li><a href="#" class="hover:text-blue-300">About</a></li>
                <li><a href="#" class="hover:text-blue-300">Services</a></li>
                <li><a href="#" class="hover:text-blue-300">Rooms</a></li>
                <li><a href="#" class="hover:text-blue-300">Gallery</a></li>
                <li><a href="#" class="hover:text-blue-300">Contact</a></li>
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
            <!-- Room Card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/images/room1.jpg') }}" alt="Room" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Deluxe Room</h3>
                    <p class="text-gray-600">City view, king-size bed, free Wi-Fi.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Book Now
                    </a>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/images/room1.jpg') }}" alt="Room" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Single Room</h3>
                    <p class="text-gray-600">City view, king-size bed, free Wi-Fi.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Book Now
                    </a>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/images/room1.jpg') }}" alt="Room" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Double Room</h3>
                    <p class="text-gray-600">City view, king-size bed, free Wi-Fi.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Book Now
                    </a>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/images/room1.jpg') }}" alt="Room" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Penthouse Suites</h3>
                    <p class="text-gray-600">City view, king-size bed, free Wi-Fi.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Book Now
                    </a>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/images/room1.jpg') }}" alt="Room" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Standard Room</h3>
                    <p class="text-gray-600">City view, king-size bed, free Wi-Fi.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Book Now
                    </a>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/images/room1.jpg') }}" alt="Room" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Presidential Suites</h3>
                    <p class="text-gray-600">City view, king-size bed, free Wi-Fi.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Book Now
                    </a>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/images/room1.jpg') }}" alt="Room" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Triple Room</h3>
                    <p class="text-gray-600">City view, king-size bed, free Wi-Fi.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Book Now
                    </a>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/images/room1.jpg') }}" alt="Room" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Executive Room</h3>
                    <p class="text-gray-600">City view, king-size bed, free Wi-Fi.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Book Now
                    </a>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/images/room1.jpg') }}" alt="Room" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold">Queen Room</h3>
                    <p class="text-gray-600">City view, king-size bed, free Wi-Fi.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Book Now
                    </a>
                </div>
            </div>
            <!-- Repeat for more rooms -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-6">
        <div class="text-center">
            &copy; 2024 eHotel. All Rights Reserved.
        </div>
    </footer>
</body>
</html>