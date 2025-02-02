<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\Models\RecentActivity;
use App\Models\Booking;

class BookingController extends Controller
{
    public function showBookingStep(Request $request)
{
    
    // Debugging to confirm query parameters
    \Log::info('Booking Parameters:', $request->all());


    $roomId = $request->query('room_id');
    $room = Room::findOrFail($roomId);
    $checkIn = $request->query('check_in');
    $checkOut = $request->query('check_out');

    return view('user.step', compact('room','checkIn','checkOut'));
}
public function calculatePrice(Request $request)
{
    $roomPrices = [
        'Deluxe Room' => 250,
        'Single Room' => 80,
        'Double Room' => 150,
        'Penthouse Suite' => 500,
        'Presidential Suite' => 800,
        'Triple Room' => 200,
        'Executive Room' => 300,
        'Queen’s Room' => 200,
    ];

    $roomType = $request->input('room_type');
    $numAdults = $request->input('number_of_adults', 0);
    $numChildren = $request->input('number_of_children', 0);

    $basePrice = $roomPrices[$roomType] ?? 0;
    $totalPrice = $basePrice + ($numAdults * 50) + ($numChildren * 25);

    return response()->json([
        'total_price' => $totalPrice,
    ]);
    RecentActivity::create([
        'user_id' => Auth::id(),
        'activity_type' =>'booked_room',
        'description' => 'Booked a room:' . $room->name,
       ]);
}
public function showCheckAvailability(Request $request)
{
    $roomId = $request->query('room_id');
    $room = Room::findOrFail($roomId);

    return view('user.check_availability', compact('room'));
}

public function edit($id) {
    $booking = Booking::with('room')->findOrFail($id);

    // pass the booking details to the view
    return view('user.edit',compact('booking'));
}
 public function update(Request $request,$id) {
    $request->validate([
        'check_in' => 'required|date|after_or_equal:today',
        'check_out' => 'required|date|after:check:in',
        'adults' => 'required|integer|min:1',
        'children' => 'nullable|integer|min:0',

    ]);
    $booking = Booking::findOrFail($id);
    $booking->update($request->only(['check_in', 'check_out', 'adults', 'children']));

    return redirect()->route('confirmation', ['id' => $booking->id])
                     ->with('success', 'Booking updated successfully!');
}
 }

