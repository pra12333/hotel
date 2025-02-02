<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            font-size: 24px;
        }
        p {
            color: #555555;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Booking Confirmation</h1>
        <p><strong>Room Type:</strong> {{ $booking->room->room_type }}</p>
        <p><strong>Check-in:</strong> {{ $booking->check_in }}</p>
        <p><strong>Check-out:</strong> {{ $booking->check_out }}</p>
        <p><strong>Guests:</strong> {{ $booking->adults }} Adults, {{ $booking->children }} Children</p>
        <p><strong>Total Price:</strong> ${{ $booking->total_price }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($booking->payment_status) }}</p>
        <p><strong>Reference Number:</strong> {{ $booking->reference_number }}</p>

        <p>Thank you for booking with us!</p>
    </div>
</body>
</html>
