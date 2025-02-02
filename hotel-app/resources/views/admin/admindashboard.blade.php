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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
        #calendar-header button {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

#calendar-days div {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

#calendar-days div.bg-blue-500 {
    background-color: #2563eb; /* Tailwind's blue-500 */
    color: white;
}
/* Style the scrollbar track and thumb */
::-webkit-scrollbar {
    width: 8px; /* Adjust the scrollbar width */
}

::-webkit-scrollbar-track {
    background: #1f2937; /* Dark gray for the track (background of scrollbar) */
    border-radius: 4px; /* Optional: rounded corners */
}

::-webkit-scrollbar-thumb {
    background: #374151; /* Slightly lighter gray for the scrollbar thumb */
    border-radius: 4px; /* Optional: rounded corners */
}

::-webkit-scrollbar-thumb:hover {
    background: #4b5563; /* Lighter gray for the thumb when hovered */
}

    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
@if(session('success'))
    <div class="bg-green-500 text-white p-2 rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-500 text-white p-2 rounded">
        {{ session('error') }}
    </div>
@endif

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
    <main class="flex-grow p-6 space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <!-- <input type="text" placeholder="Search here" class="bg-gray-800 text-gray-300 px-4 py-2 rounded-lg focus:outline-none"> -->
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-blue-600 p-6 rounded-lg shadow-md text-center">
            <h2 id="newBookings" class="text-3xl font-bold">0</h2>
                <p class="text-lg">New Bookings</p>
            </div>
            <div class="bg-green-600 p-6 rounded-lg shadow-md text-center">
            <h2 id="scheduledRooms" class="text-3xl font-bold">0</h2>
                <p class="text-lg">Schedule Room</p>
            </div>
            <div class="bg-yellow-500 p-6 rounded-lg shadow-md text-center">
            <h2 id="checkInCount" class="text-3xl font-bold">{{$checkInCount}}</h2>
            <p class="text-lg">Check In</p>
            </div>
            <div class="bg-red-500 p-6 rounded-lg shadow-md text-center">
            <h2 id="checkOuts" class="text-3xl font-bold">{{$checkOutCount}}</h2>
                <p class="text-lg">Check Out</p>
            </div>
        </div>

        <!-- Reservation Statistic -->
        <div class="flex space-x-4">
    <!-- Reservation Statistic (Graph) -->
    <div class="bg-gray-800 p-4 rounded-lg shadow-md w-1/2">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Reservation Statistic</h2>
            <div class="flex space-x-4">
            <div class="text-gray-400 flex items-center">
        <span class="w-4 h-4 bg-blue-500 rounded-full inline-block mr-2"></span>
        <span id="checkInNumber">0</span> Check In
    </div>
    <div class="text-gray-400 flex items-center">
        <span class="w-4 h-4 bg-red-500 rounded-full inline-block mr-2"></span>
        <span id="checkOutNumber">0</span> Check Out
    </div>
            </div>
        </div>
        <div class="aspect-square">
            <canvas id="reservationChart" class="w-full h-full"></canvas>
        </div>
    </div>

    <!-- Booked Room Today -->
    <!-- Booked Room Today -->
<div class="bg-gray-800 p-4 rounded-lg shadow-md w-1/3 h-64 flex flex-col justify-between">
    <h2 class="text-lg font-bold text-white">Booked Room Today</h2>
    <!-- Progress Bars -->
    <div class="space-y-2">
        <!-- Pending -->
        <div class="flex items-center">
        <div class="bg-orange-400 h-3 rounded-full" style="width: 0;"></div>
        <span class="text-orange-400 text-sm ml-2">0 Pending</span>
    </div>
        <!-- Done -->
        <div class="flex items-center">
        <div class="bg-teal-400 h-3 rounded-full" style="width: 0;"></div>
        <span class="text-teal-400 text-sm ml-2">0 Paid</span>
    </div>
       
    </div>
    </div>
    <!-- Labels -->
    <!-- <div class="flex justify-between text-sm text-gray-300">
        <div class="flex items-center">
            <div class="w-3 h-3 bg-orange-400 rounded-full mr-2"></div>
            <span>234 Pending</span>
        </div>
        <div class="flex items-center">
            <div class="w-3 h-3 bg-teal-400 rounded-full mr-2"></div>
            <span>65 Done</span>
        </div>
        <div class="flex items-center">
            <div class="w-3 h-3 bg-purple-400 rounded-full mr-2"></div>
            <span>763 Finish</span>
        </div>
    </div>  -->
        <!-- Donut Charts Section -->
        <div class="mt-6 grid grid-cols-2 gap-4">
        <!-- Check In Chart -->
        <div class="text-center">
    <canvas id="checkInChart" class="w-full h-32"></canvas>
    <p id="checkInPercentage" class="text-white font-bold mt-2">0% Check In</p>
</div>
        <!-- Check Out Chart -->
        <div class="text-center">
    <canvas id="checkOutChart" class="w-full h-32"></canvas>
    <p id="checkOutPercentage" class="text-white font-bold mt-2">0% Check Out</p>
</div>
    </div>
</div>

<div id="pendingPaymentsSection" class="mt-6">
    <h2 class="text-lg font-bold text-gray-300">Pending Payments</h2>
    <div id="pendingPaymentsContainer" class="grid grid-cols-2 gap-4 mt-4">
        <!-- Pending payments will be populated here dynamically -->
    </div>
</div>

<div id="canceledPaymentsSection" class="mt-6">
    <h2 class="text-lg font-bold text-gray-300">Canceled Payments</h2>
    <div id="canceledPaymentsContainer" class="grid grid-cols-2 gap-4 mt-4">
        <!-- Canceled payments will be populated here dynamically -->
    </div>
</div>


  <!-- Calendar and Reviews -->
        <div class="bg-gray-800 p-4 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-lg font-bold text-center text-gray-300">Calendar</h2>
    <div class="mt-4">
        <!-- Month Header -->
        <div id="calendar-header" class="flex justify-between items-center text-gray-300 mb-4">
            <button id="prev-month" class="bg-gray-700 p-2 rounded-lg hover:bg-gray-600">&lt;</button>
            <h3 id="current-month" class="text-lg font-bold">January 2025</h3>
            <button id="next-month" class="bg-gray-700 p-2 rounded-lg hover:bg-gray-600">&gt;</button>
        </div>

        <!-- Days of the Week -->
        <div class="grid grid-cols-7 gap-2 text-center text-gray-400 text-sm">
            <div>Su</div>
            <div>Mo</div>
            <div>Tu</div>
            <div>We</div>
            <div>Th</div>
            <div>Fr</div>
            <div>Sa</div>
        </div>

        <!-- Days -->
        <div id="calendar-days" class="grid grid-cols-7 gap-2 text-center text-gray-200 text-sm mt-2"></div>
    </div>
    <!-- Newest Booking Section -->
    <div class="mt-6">
        <h2 class="text-lg font-bold text-gray-300">Newest Booking</h2>
        <div id="latestBookingsList" class="grid grid-cols-2 gap-4 mt-4">
            <!-- Booking items will be appended here dynamically -->
        </ul>
        </div>
    </div>
</div>
</div>
 </div>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow-md">
    <div class="container mx-auto p-6 bg-gray-900 rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-white">User Reviews</h1>

        <table class="table-auto w-full bg-gray-800 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-700 text-gray-300">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Room</th>
                    <th class="px-4 py-2">Review</th>
                    <th class="px-4 py-2">Rating</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr class="hover:bg-gray-700 border-b border-gray-600">
                        <td class="px-4 py-2 text-gray-300">{{ $review->id }}</td>
                        <td class="px-4 py-2 text-gray-300">{{ $review->user->name ?? 'Unknown User' }}</td>
                        <td class="px-4 py-2 text-gray-300">{{ $review->room->room_type ?? 'Unknown Room' }}</td>
                        <td class="px-4 py-2 text-gray-300">{{ $review->review }}</td>
                        <td class="px-4 py-2 text-gray-300">{{ $review->rating }}</td>
                        <td class="px-4 py-2">
                            <button onclick="editReview({{ $review->id }}, '{{ $review->review }}', {{ $review->rating }})" class="bg-blue-500 text-white px-3 py-1 rounded-lg">Edit</button>
                            <button onclick="deleteReview({{ $review->id }})" class="bg-red-500 text-white px-3 py-1 rounded-lg">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div id="edit-modal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg shadow-md w-2/3 max-w-xl">
        <h2 class="text-lg font-bold mb-4 text-white text-center">Edit Review</h2>
        <form id="edit-review-form">
            <input type="hidden" id="edit-review-id">
            <div class="mb-6">
                <label for="edit-review" class="block text-sm font-medium text-gray-300">Review</label>
                <textarea 
                    id="edit-review" 
                    class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-900 text-gray-300" 
                    rows="5"
                    placeholder="Enter your review"
                ></textarea>
            </div>
            <div class="mb-6">
                <label for="edit-rating" class="block text-sm font-medium text-gray-300">Rating</label>
                <input 
                    type="number" 
                    id="edit-rating" 
                    class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-900 text-gray-300" 
                    min="1" 
                    max="5" 
                    placeholder="Enter a rating (1-5)"
                >
            </div>
            <div class="flex justify-end">
                <button 
                    type="button" 
                    class="bg-red-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-red-600" 
                    onclick="closeModal()"
                >
                    Cancel
                </button>
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
                >
                    Save
                </button>
            </div>
        </form>
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
        document.addEventListener('DOMContentLoaded', function () {
    const daysContainer = document.getElementById('calendar-days');
    const currentMonth = document.getElementById('current-month');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');

    let date = new Date();

    function renderCalendar() {
        const year = date.getFullYear();
        const month = date.getMonth();
        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
        const lastDayOfLastMonth = new Date(year, month, 0).getDate();

        currentMonth.innerText = date.toLocaleDateString('en-US', {
            month: 'long',
            year: 'numeric',
        });

        daysContainer.innerHTML = '';

        // Add days of the previous month for padding
        for (let i = firstDayOfMonth; i > 0; i--) {
            const day = document.createElement('div');
            day.classList.add('text-gray-500');
            day.innerText = lastDayOfLastMonth - i + 1;
            daysContainer.appendChild(day);
        }

        // Add days of the current month
        for (let i = 1; i <= lastDateOfMonth; i++) {
            const day = document.createElement('div');
            day.classList.add('py-2');
            if (
                i === new Date().getDate() &&
                month === new Date().getMonth() &&
                year === new Date().getFullYear()
            ) {
                day.classList.add('bg-blue-500', 'text-white', 'rounded-full');
            }
            day.innerText = i;
            daysContainer.appendChild(day);
        }

        // Add next month's days to fill remaining spaces
        const remainingDays = 7 - (daysContainer.children.length % 7);
        if (remainingDays < 7) {
            for (let i = 1; i <= remainingDays; i++) {
                const day = document.createElement('div');
                day.classList.add('text-gray-500');
                day.innerText = i;
                daysContainer.appendChild(day);
            }
        }
    }

    prevMonthBtn.addEventListener('click', () => {
        date.setMonth(date.getMonth() - 1);
        renderCalendar();
    });

    nextMonthBtn.addEventListener('click', () => {
        date.setMonth(date.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();
});
const ctx = document.getElementById('reservationChart').getContext('2d');
const reservationChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
        datasets: [
            {
                label: 'Check In',
                data: [400, 600, 800, 700, 900, 800, 950, 1000, 900, 850, 700, 750],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                fill: true,
                tension: 0.4,
            },
            {
                label: 'Check Out',
                data: [300, 500, 600, 550, 700, 600, 800, 850, 700, 750, 600, 650],
                borderColor: '#fb7185',
                backgroundColor: 'rgba(251, 113, 133, 0.2)',
                fill: true,
                tension: 0.4,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Ensures proper scaling
        plugins: {
            legend: {
                display: false, // Hide legend
            },
        },
        scales: {
            x: {
                grid: {
                    display: false,
                },
                ticks: {
                    color: '#d1d5db', // Light gray
                },
            },
            y: {
                grid: {
                    color: '#374151', // Dark gray grid lines
                },
                ticks: {
                    color: '#d1d5db',
                },
                beginAtZero: true,
            },
        },
    },
});

// Function to fetch Check In and Check Out data
function fetchCheckInCheckOutData() {
        fetch('{{ route('admin.checkInCheckOutData') }}')
            .then(response => response.json())
            .then(data => {
                // Update percentages
                document.querySelector('#checkInPercentage').innerText = `${data.checkInPercentage.toFixed(1)}% Check In`;
                document.querySelector('#checkOutPercentage').innerText = `${data.checkOutPercentage.toFixed(1)}% Check Out`;

                // Update the doughnut charts
                updateChart(checkInChart, [data.checkInPercentage, 100 - data.checkInPercentage]);
                updateChart(checkOutChart, [data.checkOutPercentage, 100 - data.checkOutPercentage]);
            })
            .catch(error => console.error('Error fetching Check In/Check Out data:', error));
    }

    // Function to update a Chart.js chart
    function updateChart(chart, data) {
        chart.data.datasets[0].data = data;
        chart.update();
    }

// Initialize Chart.js charts
const checkInCtx = document.getElementById('checkInChart').getContext('2d');
    const checkOutCtx = document.getElementById('checkOutChart').getContext('2d');

    const checkInChart = new Chart(checkInCtx, {
        type: 'doughnut',
        data: {
            labels: ['Check In', 'Remaining'],
            datasets: [{
                data: [0, 100],
                backgroundColor: ['#2563eb', '#e5e7eb'], // Blue and Gray
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: { display: false },
            },
        },
    });

    const checkOutChart = new Chart(checkOutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Check Out', 'Remaining'],
            datasets: [{
                data: [0, 100],
                backgroundColor: ['#f59e0b', '#e5e7eb'], // Orange and Gray
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: { display: false },
            },
        },
    });

    // Fetch data on page load and every 5 seconds
    fetchCheckInCheckOutData();
    setInterval(fetchCheckInCheckOutData, 5000);


function editReview(id, review, rating) {
        document.getElementById('edit-review-id').value = id;
        document.getElementById('edit-review').value = review;
        document.getElementById('edit-rating').value = rating;
        document.getElementById('edit-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }

    document.getElementById('edit-review-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const id = document.getElementById('edit-review-id').value;
        const review = document.getElementById('edit-review').value;
        const rating = document.getElementById('edit-rating').value;

        fetch(`/admin/reviews/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ review, rating }),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    });

    function deleteReview(id) {
        if (confirm('Are you sure you want to delete this review?')) {
            fetch(`/admin/reviews/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        }
    }
    function fetchDashboardStats() {
    $.ajax({
        url: '/admin/dashboard-stats',
        method: 'GET',
        success: function(data) {
            $('#checkInCount').text(data.checkInCount);
            $('#checkOutCount').text(data.checkOutCount);
        },
        error: function(error) {
            console.error('Error fetching dashboard stats:', error);
        }
    });
}

// Call this function on page load or at intervals
fetchDashboardStats();

function fetchDashboardData() {
        fetch('{{ route('admin.dashboardData') }}')
            .then(response => response.json())
            .then(data => {
                // Update the stats
                document.getElementById('newBookings').innerText = data.newBookings;
                document.getElementById('scheduledRooms').innerText = data.scheduledRooms;
            })
            .catch(error => console.error('Error fetching dashboard data:', error));
    }

    // Fetch data every 5 seconds
    setInterval(fetchDashboardData, 5000);

    // Initial fetch
    fetchDashboardData();

    function fetchReservationStats() {
    fetch('{{ route('admin.reservationStats') }}')
        .then(response => response.json())
        .then(data => {
            // Update Check In and Check Out numbers
            document.querySelector('#checkInNumber').innerText = data.checkIn;
            document.querySelector('#checkOutNumber').innerText = data.checkOut;

            // Update Chart Data
            updateReservationChart(data.checkIn, data.checkOut);
        })
        .catch(error => console.error('Error fetching reservation stats:', error));
}

// Function to update the Chart.js chart
function updateReservationChart(checkIn, checkOut) {
    reservationChart.data.datasets[0].data = [checkIn, checkOut];
    reservationChart.update(); // Refresh the chart
}

// Call the fetch function every 5 seconds
setInterval(fetchReservationStats, 5000);

// Initial fetch
fetchReservationStats();

function fetchBookedRoomData() {
    fetch('{{ route('admin.bookedRoomData') }}')
        .then(response => response.json())
        .then(data => {
            const total = data.total;

            // Calculate widths dynamically
            const pendingWidth = total > 0 ? (data.pending / total) * 100 : 0;
            const paidWidth = total > 0 ? (data.paid / total) * 100 : 0;

            // Update progress bars
            document.querySelector('.bg-orange-400').style.width = `${pendingWidth}%`;
            document.querySelector('.bg-teal-400').style.width = `${paidWidth}%`;

            // Update labels
            document.querySelector('.text-orange-400').innerText = `${data.pending} Pending`;
            document.querySelector('.text-teal-400').innerText = `${data.paid} Paid`;
        })
        .catch(error => console.error('Error fetching booked room data:', error));
}

// Fetch data every 5 seconds
setInterval(fetchBookedRoomData, 5000);

// Initial fetch
fetchBookedRoomData();

function fetchLatestBookings() {
    fetch('{{ route('admin.latestBookings') }}')
        .then(response => response.json())
        .then(data => {
            const bookingsList = document.getElementById('latestBookingsList');
            bookingsList.innerHTML = ''; // Clear existing bookings

            data.forEach(booking => {
                bookingsList.innerHTML += `
                    <li class="bg-gray-900 p-4 rounded-lg text-gray-300">
                        <p class="font-bold text-white">${booking.user.name}</p>
                        <p class="text-gray-400 text-sm">${new Date(booking.created_at).toLocaleDateString()}</p>
                        <p class="text-gray-500 text-sm">${booking.room.room_type}</p>
                    </li>
                `;
            });
        })
        .catch(error => console.error('Error fetching latest bookings:', error));
}

// Fetch the latest bookings every 5 seconds
setInterval(fetchLatestBookings, 5000);

// Initial fetch
fetchLatestBookings();

function fetchPaymentStatus() {
    fetch('{{ route('admin.paymentStatus') }}')
        .then(response => response.json())
        .then(data => {
            console.log('Payment Status Data:', data);

            const pendingContainer = document.querySelector('#pendingPaymentsContainer');
            const canceledContainer = document.querySelector('#canceledPaymentsContainer');

            // Clear existing content
            pendingContainer.innerHTML = '';
            canceledContainer.innerHTML = '';

            // Populate pending payments
            if (data.pendingPayments.length > 0) {
                data.pendingPayments.forEach(payment => {
                    pendingContainer.innerHTML += `
                        <div class="bg-gray-900 p-4 rounded-lg">
                            <p class="font-bold text-white">${payment.user?.name || 'Unknown User'}</p>
                            <p class="text-gray-400 text-sm">Room: ${payment.room?.room_type || 'Unknown Room'}</p>
                            <p class="text-gray-400 text-sm">Date: ${new Date(payment.created_at).toLocaleDateString()}</p>
                            <p class="text-yellow-400 text-sm">Status: Pending</p>
                        </div>
                    `;
                });
            } else {
                pendingContainer.innerHTML = `<p class="text-gray-400">No pending payments at the moment.</p>`;
            }

            // Populate canceled payments
            if (data.canceledPayments.length > 0) {
                data.canceledPayments.forEach(payment => {
                    canceledContainer.innerHTML += `
                        <div class="bg-gray-900 p-4 rounded-lg">
                            <p class="font-bold text-white">${payment.user?.name || 'Unknown User'}</p>
                            <p class="text-gray-400 text-sm">Room: ${payment.room?.room_type || 'Unknown Room'}</p>
                            <p class="text-gray-400 text-sm">Date: ${new Date(payment.created_at).toLocaleDateString()}</p>
                            <p class="text-red-400 text-sm">Status: Canceled</p>
                        </div>
                    `;
                });
            } else {
                canceledContainer.innerHTML = `<p class="text-gray-400">No canceled payments at the moment.</p>`;
            }
        })
        .catch(error => console.error('Error fetching payment status:', error));
}

// Fetch data every 5 seconds
setInterval(fetchPaymentStatus, 5000);

// Initial fetch
fetchPaymentStatus();


    </script>
</body>
</html>
