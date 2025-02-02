<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Listing</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4">
            <div class="text-2xl font-bold">
                <a href="#">
                    <img src="{{ asset('storage/images/royal.jpg') }}" alt="E Hotel Logo" class="h-12">
                </a>
            </div>
            <ul class="flex space-x-6 text-lg">
                <li><a href="#" class="hover:text-blue-300">Home</a></li>
                <li><a href="#" class="hover:text-blue-300">About</a></li>
                <li><a href="#" class="hover:text-blue-300">Services</a></li>
                <li><a href="#" class="hover:text-blue-300">Rooms</a></li>
                <li><a href="#" class="hover:text-blue-300">Gallery</a></li>
                <li><a href="#" class="hover:text-blue-300">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Continue Payment Section -->
    <main class="flex justify-center items-center min-h-screen">
        <div class="bg-white shadow-lg rounded-lg p-10 max-w-lg w-full">
            <h1 class="text-3xl font-bold text-center text-blue-700 mb-6">Continue Payment</h1>
            <p class="text-gray-600 text-center mb-6">Complete your payment for booking <strong>#{{ $booking->id }}</strong>.</p>

            <form action="{{ route('payment.process', ['bookingId' => $booking->id]) }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="check_in" value="{{ $booking->check_in }}">
                <input type="hidden" name="check_out" value="{{ $booking->check_out }}">
                <input type="hidden" name="adults" value="{{ $booking->adults }}">
                <input type="hidden" name="children" value="{{ $booking->children }}">
                <input type="hidden" name="total_price" value="{{ $booking->total_price }}">

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" id="name" 
                        class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Enter your full name" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" 
                        class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Enter your email address" required>
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                    <input type="text" name="phone" id="phone" 
                        class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Enter your phone number" required>
                </div>

                <!-- Payment Method -->
                <div>
                    <label for="payment_method" class="block text-sm font-bold text-gray-700 mb-2">Payment Method</label>
                    <select name="payment_method" id="payment_method" 
                        class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>

                <!-- Card Number -->
                <div>
                    <label for="card_number" class="block text-sm font-bold text-gray-700 mb-2">Card Number</label>
                    <input
                        type="text"
                        id="card_number"
                        name="card_number"
                        placeholder="1234 5678 9000 0000"
                        class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        maxlength="19"
                        required>
                </div>

                <!-- Cardholder Name -->
                <div>
                    <label for="cardholder_name" class="block text-sm font-bold text-gray-700 mb-2">Cardholder Name</label>
                    <input type="text" name="cardholder_name" id="cardholder_name" 
                        class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Name on the card" required>
                </div>

                <!-- Expiry Date and CVV -->
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="expiry_date" class="block text-sm font-bold text-gray-700 mb-2">Expiry Date</label>
                        <input type="text" name="expiry_date" id="expiry_date" 
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            placeholder="MM/YY" required>
                    </div>
                    <div class="flex-1">
                        <label for="cvv" class="block text-sm font-bold text-gray-700 mb-2">CVV</label>
                        <input type="text" name="cvv" id="cvv" 
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg shadow focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            placeholder="CVV" maxlength="3" pattern="\d{3}" title="CVV must be exactly 3 digits" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg shadow font-bold">
                    Pay Now
                </button>

                @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg shadow">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-6 mt-10">
        <div class="text-center">
            &copy; 2024 E Hotel. All Rights Reserved.
        </div>
    </footer>
    <script>
        // Script for Card Number Formatting and Expiry Date Validation
        document.addEventListener('DOMContentLoaded', () => {
            const cardNumberInput = document.getElementById('card_number');
            const expiryDateInput = document.getElementById('expiry_date');

            // Format card number with spaces every 4 digits
            cardNumberInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '').substring(0, 16); // Allow only digits, max 16
                value = value.replace(/(\d{4})(?=\d)/g, '$1 '); // Add a space every 4 digits
                e.target.value = value;
            });

            // Validate expiry date format (MM/YY)
            expiryDateInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '').substring(0, 4); // Allow only digits, max 4
                if (value.length > 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2); // Add '/' after MM
                }
                e.target.value = value;
            });
        });
    </script>

</body>
</html>
