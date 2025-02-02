<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Cancellation Receipt</title>
</head>
<body>
    <h1>Booking Cancellation Receipt</h1>
    <p>Dear {{ $booking->user->name }},</p>
    <p>Your booking for room <strong>#{{ $booking->room->room_type }}</strong> from <strong>{{ $booking->check_in }}</strong> to <strong>{{ $booking->check_out }}</strong> has been canceled successfully.</p>
    <p><strong>Retained Amount:</strong> ${{ number_format($retainedAmount, 2) }}</p>
    <p><strong>Refund Amount:</strong> ${{ number_format($refundAmount, 2) }}</p>
    <p>If you have any questions, feel free to contact us.</p>
    <p>Thank you,</p>
    <p>The E Hotel Team</p>
</body>
</html>
