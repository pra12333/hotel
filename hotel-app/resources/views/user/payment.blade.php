<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - E Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-100">
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
                <form action= "{{route('logout') }}" method="POST">
                    @csrf 
                    <button type="button" onclick="showLogoutModal()" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
    Logout
</button>
</form>
            </div>
        </div>
    </nav>

    <!-- Payment Page Content -->
    <main class="container mx-auto py-10 grid grid-cols-1 lg:grid-cols-2 gap-8">
       <!-- Left: Booking Summary -->
<section class="bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Booking Summary</h2>
    <!-- Room Image -->
    <img src="{{ asset('storage/images/' . $room->image) }}" alt="Room Image" class="w-full h-48 object-cover rounded-lg mb-4">
    <!-- Booking Details -->
    <div class="space-y-2">
        <p class="text-gray-600"><span class="font-bold">Room Type:</span> {{ $room->room_type }}</p>
        <p class="text-gray-600"><span class="font-bold">Check-in:</span> {{ $checkIn }}</p>
        <p class="text-gray-600"><span class="font-bold">Check-out:</span> {{ $checkOut }}</p>
        <p class="text-gray-600"><span class="font-bold">Guests:</span> {{ $adults }} Adults, {{ $children }} Children</p>
        <p class="text-gray-600"><span class="font-bold">Price:</span> ${{ $price }}</p>
    </div>
</section>

        <!-- Right: Payment Form -->
        <section class="bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Payment Information</h2>
    <form id="paymentForm" action="{{ route('payment.process') }}" method="POST">
    @csrf

    <!-- Hidden Fields for Room and Booking Details -->
    <input type="hidden" name="room_id" value="{{ $room->id }}">
    <input type="hidden" name="check_in" value="{{ $checkIn }}">
    <input type="hidden" name="check_out" value="{{ $checkOut }}">
    <input type="hidden" name="adults" value="{{ $adults }}">
    <input type="hidden" name="children" value="{{ $children }}">
    <input type="hidden" name="total_price" value="{{ $price }}">

    <!-- Personal Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input type="text" name="name" placeholder="Full Name" class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <input type="email" name="email" placeholder="Email Address" class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <input type="text" name="phone" placeholder="Phone Number" class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <!-- Payment Method -->
    <div class="mt-4">
        <label for="payment_method" class="block text-gray-600 font-bold mb-2">Payment Method</label>
        <select id="payment_method" name="payment_method" class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="credit_card">Credit Card</option>
            <option value="bank_transfer">Bank Transfer</option>
            <option value="paypal">PayPal</option>
        </select>
    </div>

    <!-- Card Details -->
    <div class="mt-6">
    <label class="block text-gray-600 font-bold mb-2">Card Details</label>

    <!-- Card Number and Cardholder Name -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input
            type="text"
            id="card_number"
            name="card_number"
            placeholder="1234 5678 9000 0000"
            class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            maxlength="19"
            required>
        <input
            type="text"
            name="cardholder_name"
            placeholder="Cardholder Name"
            class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
    </div>

    <!-- Expiry Date and CVV -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        <!-- Expiry Month Dropdown -->
        <select
            name="expiry_month"
            id="expiry_month"
            class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
            <option value="">Month</option>
            <option value="01">01 - January</option>
            <option value="02">02 - February</option>
            <option value="03">03 - March</option>
            <option value="04">04 - April</option>
            <option value="05">05 - May</option>
            <option value="06">06 - June</option>
            <option value="07">07 - July</option>
            <option value="08">08 - August</option>
            <option value="09">09 - September</option>
            <option value="10">10 - October</option>
            <option value="11">11 - November</option>
            <option value="12">12 - December</option>
        </select>

        <!-- Expiry Year Dropdown -->
        <select
            name="expiry_year"
            id="expiry_year"
            class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
            <option value="">Year</option>
        </select>

        <!-- CVV -->
        <input
            type="text"
            name="cvv"
            placeholder="CVV"
            class="w-full py-3 px-6 rounded-lg text-gray-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
            maxlength="3"
            pattern="\d{3}"
            title="CVV must be exactly 3 digits">
    </div>

    <!-- Hidden Combined Expiry Date -->
    <input type="hidden" name="expiry_date" id="expiry_date" required>
</div>

   

    <!-- Payment Logos -->
    <div class="mt-6 flex justify-center space-x-4">
        <img src="{{ asset('storage/images/visa.jpg') }}" alt="Visa" class="h-8">
        <img src="{{ asset('storage/images/mastercard.jpg') }}" alt="MasterCard" class="h-8">
        <img src="{{ asset('storage/images/paypal.jpg') }}" alt="PayPal" class="h-8">
        <img src="{{ asset('storage/images/amex.jpg') }}" alt="American Express" class="h-8">
        <img src="{{ asset('storage/images/apple.jpg') }}" alt="Apple Pay" class="h-8">
    </div>

    <!-- Submit Button -->
    <div class="flex justify-center mt-6">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-8 rounded-lg shadow font-bold">
            Pay Now
        </button>
    </div>
    <!-- Pay Later Button -->
<div class="flex justify-center mt-6">
    <button 
        type="button" 
        onclick="payLater()" 
        class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-8 rounded-lg shadow font-bold">
        Pay Later
    </button>
</div>
</form>

</section>

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
    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-6 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 E Hotel. All Rights Reserved.</p>
        </div>
    </footer>
    <script>
      function submitPayment() {
    const formData = new FormData(document.getElementById('paymentForm'));

    fetch('{{ route('payment.process') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        },
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                // Show success modal
                document.getElementById('successModal').classList.remove('hidden');

                // Redirect after a short delay
                setTimeout(() => {
                    window.location.href = `{{ route('confirmation', ':id') }}`.replace(':id', data.booking_id);
                }, 2000); // 2 seconds delay to show the success message
            } else {
                alert('Failed to process the payment: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error processing payment:', error);
            alert('An error occurred. Please try again.');
        });
}

const cardNumberInput = document.getElementById('card_number');

    cardNumberInput.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
        value = value.match(/.{1,4}/g)?.join(' ') || ''; // Group into 4 digits
        e.target.value = value; // Update the input field
    });

// Modal Functions
function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
        </script>
        <!-- Modal Section -->
<div id="successModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-lg font-bold text-gray-800">Payment Successful</h2>
        <p class="text-gray-600 mt-2">Your payment was processed successfully!</p>
        <div class="flex justify-end space-x-4 mt-4">
            <button onclick="closeSuccessModal()" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                OK
            </button>
        </div>
    </div>
</div>

<script>
    function closeSuccessModal() {
        document.getElementById('successModal').classList.add('hidden');
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const currentYear = new Date().getFullYear();
    const expiryYearSelect = document.getElementById('expiry_year');
    const expiryMonthSelect = document.getElementById('expiry_month');
    const expiryDateField = document.getElementById('expiry_date');

    // Populate year dropdown starting from the current year
    for (let year = currentYear; year <= currentYear + 10; year++) {
        const option = document.createElement('option');
        option.value = year.toString().slice(-2); // Use the last two digits (e.g., '24')
        option.textContent = year;
        expiryYearSelect.appendChild(option);
    }

    // Update the hidden expiry_date field when month or year changes
    function updateExpiryDateField() {
        const month = expiryMonthSelect.value;
        const year = expiryYearSelect.value;

        if (month && year) {
            expiryDateField.value = `${month}/${year}`; // Combine into MM/YY format
        }
    }

    expiryMonthSelect.addEventListener('change', updateExpiryDateField);
    expiryYearSelect.addEventListener('change', updateExpiryDateField);

    // Optional: Add form validation before submission
    document.querySelector('form').addEventListener('submit', function (e) {
        if (!expiryDateField.value) {
            e.preventDefault();
            alert('Please select a valid expiry date.');
            return;
        }

        // Additional validation for current month and year
        const currentMonth = new Date().getMonth() + 1; // 0-indexed
        const currentYear = new Date().getFullYear().toString().slice(-2);
        const [selectedMonth, selectedYear] = expiryDateField.value.split('/');

        if (
            parseInt(selectedYear) === parseInt(currentYear) &&
            parseInt(selectedMonth) < currentMonth
        ) {
            e.preventDefault();
            alert('The expiry date cannot be in the past.');
        }
    });
});

function payLater() {
    const formData = new FormData(document.getElementById('paymentForm'));
    formData.append('pay_later', 'true'); // Ensure pay_later is added correctly

    fetch('{{ route('payment.hold') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        },
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                alert(data.message);
                window.location.href = `{{ route('homepage') }}`;
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error processing "Pay Later":', error);
            alert('An unexpected error occurred. Please try again.');
        });
}



    </script>
</body>
</html>
