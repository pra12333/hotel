<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\RecentActivity;
use App\Models\Notification;



class PaymentController extends Controller
{
    public function showpayment(Request $request){
        $roomId = $request->query('room_id');
        $room = Room::findOrFail($roomId); // fetch the room details

        // Get user inputs from the query parameters
    $checkIn = $request->query('check_in');
    $checkOut = $request->query('check_out');
    $adults = $request->query('adults');
    $children = $request->query('children');
    // Calculate total price
    $basePrice = $room->price; // Base price per night for the room
    $adultCharge = 50; // Additional charge per adult
    $childCharge = 25; // Additional charge per child 

    // Calculate total price
    $price = $basePrice + ($adults * $adultCharge) + ($children * $childCharge);


        return view('user.payment',compact('room','checkIn','checkOut','adults','children','price'));

    }

    // public function showconfirm(){
        
    //     return view('user.confirmation');
    // }
    public function processPayment(Request $request)
{
    \Log::info('Payment Request Data:', $request->all());

    try {
        // Validation for booking and payment details
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'total_price' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string',
            'card_number' => 'required|regex:/^\d{4}\s\d{4}\s\d{4}\s\d{4}$/',
            'cardholder_name' => 'required|string|max:255',
            'expiry_date' => 'required|string|max:5',
            'cvv' => 'required|string|max:4',
        ]);

        // Check if `bookingId` is provided for an existing booking
        if ($request->filled('bookingId')) {
            $booking = Booking::findOrFail($request->bookingId);

            if ($booking->payment_status === 'paid') {
                return back()->with('info', 'This booking has already been paid.');
            }

            // Update existing booking
            $booking->update([
                'payment_status' => 'paid',
                'reference_number' => $booking->reference_number ?? uniqid(), // Ensure reference number exists
            ]);

            \Log::info('Existing booking updated:', [
                'booking_id' => $booking->id,
                'payment_status' => $booking->payment_status,
            ]);


            // Send confirmation email
            Mail::to($request->email)->send(new BookingConfirmationMail($booking));

            return redirect()->route('confirmation', ['id' => $booking->id])
                ->with('success', 'Payment completed successfully.');
        }

        // Create a new booking if no `bookingId` provided
        $children = $request->children ?? 0;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'adults' => $request->adults,
            'children' => $children,
            'total_price' => $request->total_price,
            'payment_status' => 'paid',
            'reference_number' => uniqid(),
        ]);

        // decrement available_rooms
        $room = Room::findOrFail($request->room_id);
        if($room->available_rooms <= 0) {
            return back()->withErrors(['message' => 'No available rooms for this booking.']);
        }
        $room->decrement('available_rooms');

        \Log::info('New booking created:', [
            'booking_id' => $booking->id,
            'payment_status' => $booking->payment_status,
        ]);

        // Add to recent activities
        RecentActivity::create([
            'user_id' => Auth::id(),
            'description' => "Booked room #{$booking->room_id} for {$booking->check_in} to {$booking->check_out}.",
            'activity_type' => 'booking',
        ]);

        // log info

        \Log::info('Booking activity logged:', [
            'user_id' => Auth::id(),
            'description' => "Booked room #{$booking->room_id} for {$booking->check_in} to {$booking->check_out}."
        ]);

        // Create notification for completed booking
        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'booking_completed',
            'message' => 'Your booking for Room #' . $booking->room_id . ' has been completed successfully.',
            'status' => 'unread',
        ]);

        Log::info('Notification created for completed booking:', ['booking_id' => $booking->id]);


        Mail::to($request->email)->send(new BookingConfirmationMail($booking));

        return redirect()->route('confirmation', ['id' => $booking->id])
            ->with('success', 'Payment completed successfully.');

    } catch (\Exception $e) {
        \Log::error('Payment Processing Error:', ['error' => $e->getMessage()]);

        return back()->withErrors(['message' => 'Payment failed. Please try again later.']);
    }
}

    
    

   
    


    
    

    public function paymentSuccess(Request $rqeuest) {
        // retrieve the booking id
        $bookingId = $request->get('booking_id');

        // fetch the booking details
        $booking = Booking::with('room')->findOrFail($bookingId);

        // redirect to confirmation page
        return redirect()->route('confirmation',['booking' => $booking->id]);
    }
    public function showConfirmation($id)
{
    // Fetch the booking details along with the associated room
    $booking = Booking::with('room')->findOrFail($id);

    // Pass the booking data to the confirmation view
    return view('user.confirmation', compact('booking'));
}

public function holdPayment(Request $request)
{
    Log::info('Request Data:', $request->all());

    try {
        // Validate incoming data
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'total_price' => 'required|numeric',
            'pay_later' =>  'required|in:true,false,1,0', // Accepts string or numeric booleans
        ]);

        // Check if the user already has a pending payment
        if (Auth::user()->hasPendingPayment()) {
            return response()->json(['success' => false, 'message' => 'You already have a pending payment.']);
        }

        // Create or update booking with pending status
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $validated['room_id'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'adults' => $validated['adults'],
            'children' => $validated['children'],
            'total_price' => $validated['total_price'],
            'payment_status' => 'pending',
            'expires_at' => now()->addHours(24),
        ]);

        // Create notification for the pending payment
        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'pending_payment',
            'message' => 'You have a pending payment for Booking ID: #' . $booking->id,
            'status' => 'unread',
        ]);

        \Log::info('Notification created:', ['user_id' => $booking->user_id, 'type' => 'pending_payment']);

        Log::info('Notification created for pending payment:', ['booking_id' => $booking->id]);


        return response()->json(['success' => true, 'message' => 'Payment is on hold.']);
    } catch (\Exception $e) {
        Log::error('Error in holdPayment: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'An error occurred.'], 500);
    }
}

public function continuePayment($bookingId)
{
    \Log::info('Accessed continuePayment', ['bookingId' => $bookingId]);

    $booking = Booking::find($bookingId);

    if (!$booking || $booking->payment_status !== 'pending') {
        \Log::warning('Booking not valid for payment', ['bookingId' => $bookingId]);
        return redirect()->route('homepage')->with('error', 'Invalid or expired booking.');
    }

    if (!$booking->reference_number) {
        $booking->update(['reference_number' => uniqid()]);
        \Log::info('Reference number generated for booking:', ['booking_id' => $booking->id]);
    }

    $room = $booking->room;

    if (!$room) {
        \Log::warning('Room not found for booking', ['bookingId' => $bookingId]);
        return redirect()->route('homepage')->with('error', 'Room not found.');
    }

    return view('user.continue', compact('booking', 'room'));
}
public function cancelBooking(Request $request, $bookingId)
{
    $booking = Booking::findOrFail($bookingId);

    if ($booking->canceled_at) {
        return response()->json([
            'success' => false,
            'message' => 'This booking has already been canceled.'
        ]);
    }

    // Calculate refund
    $refundAmount = $booking->total_price * 0.8;
    $retainedAmount = $booking->total_price * 0.2;

    $booking->update([
        'canceled_at' => now(),
        'refund_status' => 'processed',
    ]);

    // Increment available_rooms
    $room = Room::findOrFail($booking->room_id);
    $room->increment('available_rooms');

    // log the cancellation in recent activities
    RecentActivity::create([
        'user_id' => $booking->user_id,
        'activity_type' => 'booking_canceled',
        'description' => 'Canceled booking for room #' . $booking->room_id . 
                         ' from ' . $booking->check_in . ' to ' . $booking->check_out . 
                         '. Retained amount: $' . number_format($retainedAmount, 2) . 
                         ', Refund amount: $' . number_format($refundAmount, 2) . '.',
    ]);
   

    Log::info('Booking canceled:', [
        'booking_id' => $booking->id,
        'retained_amount' => $retainedAmount,
        'refundAmount' => $refundAmount,
    ]);

    // Create notification for canceled booking
    Notification::create([
        'user_id' => $booking->user_id,
        'type' => 'booking_canceled',
        'message' => 'Your booking for Room #' . $booking->room_id . ' has been canceled.',
        'status' => 'unread',
    ]);

    \Log::info('Notification created:', ['user_id' => $booking->user_id, 'type' => 'pending_payment']);

    Log::info('Notification created for canceled booking:', ['booking_id' => $booking->id]);


    // send cancellation receipt mail
    Mail::to($booking->user->email)->send(new \App\Mail\BookingCancellationReceiptMail($booking,$refundAmount,$retainedAmount));

    return response()->json([
        'success' => true,
        'message' => 'Booking canceled successfully.Receipt will be sent to the Mail address.',
    ]);
}

}
 
