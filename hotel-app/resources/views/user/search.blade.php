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
                <a href="{{route('homepage')}}" class="hover:text-blue-300">Home</a>
                <a href="{{route('search')}}" class="hover:text-blue-300">Search</a>
                <a href="{{route('rooms.list')}}" class="hover:text-blue-300">Rooms</a>
                <a href="{{route('profile')}}" class="hover:text-blue-300">Settings</a>
                <!-- <a href="#" class="hover:text-blue-300">Contact</a>  -->
                <form action= "{{route('logout') }}" method="POST">
                    @csrf 
                    <button type="button" onclick="showLogoutModal()" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
    Logout
</button>
</form>
            </div>
        </div>
    </nav>

    <!-- Search Section -->
    <section class="container mx-auto py-10">
    <h1 class="text-4xl font-extrabold text-gray-800 text-center mb-8">Search for Rooms and Services</h1>
    <form id="searchForm" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Keywords -->
        <div class="flex flex-col col-span-1 md:col-span-3">
            <label for="keywords" class="text-gray-600 font-bold mb-2">Search</label>
            <input 
                type="text" 
                id="keywords" 
                name="keywords" 
                placeholder="Search by room type, service, or keyword..." 
                class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Check-in Date -->
        <div class="flex flex-col">
            <label for="check_in" class="text-gray-600 font-bold mb-2">Check-in Date</label>
            <input 
                type="date" 
                id="check_in" 
                name="check_in" 
                class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Check-out Date -->
        <div class="flex flex-col">
            <label for="check_out" class="text-gray-600 font-bold mb-2">Check-out Date</label>
            <input 
                type="date" 
                id="check_out" 
                name="check_out" 
                class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Room Type -->
        <div class="flex flex-col">
            <label for="room_type" class="text-gray-600 font-bold mb-2">Room Type</label>
            <select 
    id="room_type" 
    name="room_type" 
    class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
>
    <option value="">Room Type</option>
    <option value="Deluxe Room">Deluxe Room</option>
    <option value="Single Room">Single Room</option>
    <option value="Double Room">Double Room</option>
    <option value="Penthouse Suite">Penthouse Suite</option> <!-- Corrected -->
    <option value="Presidential Suite">Presidential Suite</option> <!-- Corrected -->
    <option value="Triple Room">Triple Room</option>
    <option value="Executive Room">Executive Room</option>
    <option value="Queen’s Room">Queen’s Room</option> <!-- Corrected -->
</select>

        </div>

        <!-- Number of Rooms -->
        <div class="flex flex-col">
            <label for="number_of_rooms" class="text-gray-600 font-bold mb-2">Number of Rooms</label>
            <input 
                type="number" 
                id="number_of_rooms" 
                name="number_of_rooms" 
                placeholder="Number of Rooms" 
                class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
                min="1"
            >
        </div>
        <div class="flex flex-col">
    <label for="is_ac" class="text-gray-600 font-bold mb-2">AC/Non-AC</label>
    <select 
        id="is_ac" 
        name="is_ac" 
        class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
        <option value="">Select</option>
        <option value="1">AC</option>
        <option value="0">Non-AC</option>
    </select>
</div>


        <!-- Number of Children -->
        <div class="flex flex-col">
            <label for="number_of_children" class="text-gray-600 font-bold mb-2">Number of Children</label>
            <input 
                type="number" 
                id="number_of_children" 
                name="number_of_children" 
                placeholder="Number of Children" 
                class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
                min="0"
            >
        </div>

        <!-- Number of Adults -->
        <div class="flex flex-col">
            <label for="number_of_adults" class="text-gray-600 font-bold mb-2">Number of Adults</label>
            <input 
                type="number" 
                id="number_of_adults" 
                name="number_of_adults" 
                placeholder="Number of Adults" 
                class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
                min="1"
            >
        </div>
        <!-- Price Range Filter -->
<div class="flex flex-col">
    <label for="price_range" class="text-gray-600 font-bold mb-2">Price Range</label>
    <select 
        id="price_range" 
        name="price_range" 
        class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
        <option value="">Select</option>
        <option value="50-100">$50 - $100</option>
        <option value="101-200">$101 - $200</option>
        <option value="201-300">$201 - $300</option>
        <option value="301-500">$301 - $500</option>
        <option value="501-1000">$501 - $1000</option>
    </select>
</div>

        <!-- Free Pickup -->
        <div class="flex flex-col">
            <label for="free_pickup" class="text-gray-600 font-bold mb-2">Free Pickup</label>
            <select 
                id="free_pickup" 
                name="free_pickup" 
                class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">Free Pickup</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
<!-- Fading Message -->
<div id="fadingMessage" class="text-red-500 text-sm opacity-0 transition-opacity duration-1000 ease-in-out">
    Free pickup is available for Deluxe rooms and above.
</div>

        <!-- Search Button -->
        <div class="col-span-1 md:col-span-3">
            <button 
                type="button" 
                id="searchButton" 
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-lg shadow font-bold"
            >
                Search
            </button>
        </div>
    </form>
</section>

    <!-- Search Results -->
    <section class="container mx-auto py-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Search Results</h2>
    <div id="resultsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 min-h-[150px]">
        <!-- Dynamic content will be injected here -->
    </div>
    <!-- No Results -->
    <div id="noResultsMessage" class="mt-10 text-center hidden">
        <p class="text-gray-600 text-lg">No results found for your search. Please try again with different criteria.</p>
    </div>
</section>
<div id="paginationContainer" class="mt-6 flex justify-center space-x-4">
    <!-- Pagination buttons will be dynamically injected here -->
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
    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 E Hotel. All Rights Reserved.</p>
        </div>
    </footer>
    <script>

         document.getElementById('room_type').addEventListener('change', function () {
    const roomType = this.value;
    const freePickup = document.getElementById('free_pickup');
    const fadingMessage = document.getElementById('fadingMessage');

    // Check if the selected room type is "Single Room"
    if (roomType === 'Single Room') {
        // Show fading message
        fadingMessage.textContent = 'Free pickup is available for Deluxe rooms and above.';
        fadingMessage.classList.remove('hidden');
        fadingMessage.style.opacity = 1;

        // Fade out the message after 3 seconds
        setTimeout(() => {
            let fadeEffect = setInterval(() => {
                if (!fadingMessage.style.opacity || fadingMessage.style.opacity > 0) {
                    fadingMessage.style.opacity -= 0.1;
                } else {
                    clearInterval(fadeEffect);
                    fadingMessage.classList.add('hidden');
                }
            }, 100);
        }, 3000);

        // Disable the "Free Pickup" dropdown
        freePickup.value = '';
        freePickup.disabled = true;
        freePickup.classList.add('bg-gray-300', 'cursor-not-allowed');
    } else {
        // Enable the "Free Pickup" dropdown for other room types
        freePickup.disabled = false;
        freePickup.classList.remove('bg-gray-300', 'cursor-not-allowed');
    }
});

// Initial fetch triggered by the search button
document.getElementById('searchButton').addEventListener('click', function () {
    fetchRooms('{{ route("search.rooms") }}'); // Trigger fetchRooms with the initial route
});

// Function to fetch and render rooms with pagination support
function fetchRooms(url) {
    const checkInInput = document.getElementById('check_in').value;
    const checkOutInput = document.getElementById('check_out').value;
    const numberOfRooms = parseInt(document.getElementById('number_of_rooms').value);
    const isAc = document.getElementById('is_ac').value;
    const priceRange = document.getElementById('price_range').value;
    const keywords = document.getElementById('keywords').value;
    const roomType = document.getElementById('room_type').value;
    const freePickup = document.getElementById('free_pickup').value;

    // Validation Section

    const today = new Date();
    today.setHours(0,0,0,0); // remove time  part for accurate comparison

    // check if the check-in date is valid
    if(!checkInInput || new  Date(checkInInput) < today) {
        alert('Please select a valid Check-in Date(Today or Later).');
        return;
    }
    
    // Check if the date fields are empty
    if (!checkInInput || !checkOutInput) {
        alert('Please select both check-in and check-out dates.');
        return;
    }

    const checkIn = new Date(checkInInput);
    const checkOut = new Date(checkOutInput);

    // Validate date range
    if (checkOut <= checkIn) {
        alert('Check-out date must be later than the check-in date.');
        return;
    }

    // Validate number of rooms
    if (isNaN(numberOfRooms) || numberOfRooms <= 0) {
        alert('Please enter a valid number of rooms.');
        return;
    }


    // Clear results and hide the "No Results" message initially
    const resultsContainer = document.getElementById('resultsContainer');
    const paginationContainer = document.getElementById('paginationContainer');
    const noResultsMessage = document.getElementById('noResultsMessage');
    resultsContainer.innerHTML = ''; // Clear previous results
    paginationContainer.innerHTML = ''; // Clear pagination buttons
    noResultsMessage.classList.add('hidden'); // Hide no-results message

    // Prepare query parameters
    const params = new URLSearchParams({
        keywords: keywords,
        check_in: checkInInput,
        check_out: checkOutInput,
        room_type: roomType,
        free_pickup: freePickup,
        number_of_rooms: numberOfRooms,
        is_ac: isAc,
        price_range: priceRange,
    });

    // Fetch data from the given URL with query parameters
    fetch(`${url}?${params.toString()}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error fetching rooms');
            }
            return response.json();
        })
        .then(data => {
            if (data.data && data.data.length > 0) {
                // Render room cards
                data.data.forEach(room => {
                    if (numberOfRooms > room.available_rooms) {
                        alert(
                            `Only ${room.available_rooms} ${room.room_type}(s) are available. Please reduce the number of rooms.`
                        );
                        return;
                    }

                    const roomCard = `
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <img src="/storage/images/${room.image}" alt="${room.room_type}" class="w-full h-40 object-cover rounded-lg mb-4">
                            <h3 class="text-xl font-bold text-gray-800">${room.room_type}</h3>
                            <p class="text-gray-600 mt-2">Price: <span class="text-green-500 font-bold">$${room.price}/night</span></p>
                            <p class="text-gray-500 mt-2">${room.description}</p>
                            <p class="text-gray-500 mt-2">AC: <span class="font-bold">${room.is_ac ? 'Yes' : 'No'}</span></p>
                            <p class="text-gray-500 mt-2">Price Range: <span class="font-bold">${room.price_range}</span></p>
                            <button 
                                class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg book-now-button" 
                                data-room-id="${room.id}">Book Now</button>
                        </div>
                    `;
                    resultsContainer.insertAdjacentHTML('beforeend', roomCard);
                });

                // Render pagination buttons
                if (data.prev_page_url || data.next_page_url) {
                    let paginationHTML = '';
                    if (data.prev_page_url) {
                        paginationHTML += `<button class="py-2 px-4 bg-gray-200 rounded-lg hover:bg-blue-500 hover:text-white" onclick="fetchRooms('${data.prev_page_url}')">Previous</button>`;
                    }
                    if (data.next_page_url) {
                        paginationHTML += `<button class="py-2 px-4 bg-gray-200 rounded-lg hover:bg-blue-500 hover:text-white" onclick="fetchRooms('${data.next_page_url}')">Next</button>`;
                    }
                    paginationContainer.innerHTML = paginationHTML;
                }
            } else {
                // Show no-results message
                noResultsMessage.classList.remove('hidden');
                noResultsMessage.textContent = 'No rooms available for the selected criteria.';
            }
        })
        .catch(error => {
            console.error('Error fetching rooms:', error);
            resultsContainer.innerHTML = '<p class="text-red-500">An error occurred. Please try again later.</p>';
        });
}

// Redirect to booking page when "Book Now" button is clicked
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('book-now-button')) {
        const roomId = event.target.getAttribute('data-room-id');
        const checkIn = document.getElementById('check_in').value; // fetch the check in date
        const checkOut = document.getElementById('check_out').value; // fetch the check out date
        if (roomId) {
            const url = new URL('/booking', window.location.origin);
            url.searchParams.append('room_id', roomId);

            if (checkIn) url.searchParams.append('check_in',checkIn);
            if (checkOut) url.searchParams.append('check_out',checkOut);
            console.log("Redirect URL:", url.toString());
            window.location.href = url.toString();
        }
    }
});


 // Modal Functions
    function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
//         document.addEventListener('click', function (event) {
//     if (event.target.classList.contains('book-now-button')) {
//         const roomId = event.target.getAttribute('data-room-id');

//         if (roomId) {
//             // Redirect to the intermediate booking page
//             const url = new URL('/booking', window.location.origin);
//             url.searchParams.append('room_id', roomId);
//             window.location.href = url.toString();
//         }
//     }
// });
document.addEventListener('DOMContentLoaded', function () {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('check_in').setAttribute('min', today);
    document.getElementById('check_in').value = today;
});


        </script>
</body>
</html>
