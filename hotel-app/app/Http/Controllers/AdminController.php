<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showadmin(){
        $reviews = Review::with(['user', 'room'])
          ->orderBy('created_at','desc')
          ->take(5)
          ->get();
        \Log::info($reviews); // Log the reviews to the Laravel log file
    // dd($reviews); // D
     // Count records where check-in date is not null
     $checkInCount = Booking::whereNotNull('check_in')->count();

    // count records where check-out date is not null
    $checkOutCount = Booking::whereNotNull('check_out')->count();
        return view('admin.admindashboard',compact('reviews','checkOutCount','checkInCount'));
    }
    public function getDashboardStats() {
        $checkInCount = Booking::whereNotNull('check_in')->count();
        $checkOutCount = Booking::whereNotNull('check_out')->count();
    
        return response()->json([
            'checkInCount' => $checkInCount,
            'checkOutCount' => $checkOutCount,
        ]);
    }

    public function getDashboardData()
{
    $newBookings = \App\Models\Booking::count(); // Count of all bookings
    $scheduledRooms = \App\Models\Room::where('available_rooms', '>', 0)->count(); // Count of available rooms
    
    return response()->json([
        'newBookings' => $newBookings,
        'scheduledRooms' => $scheduledRooms,
        
    ]);
}
public function getReservationStats()
{
    $checkInCount = Booking::where('check_in', '<=', now())->count();
    $checkOutCount = Booking::where('check_out', '<=', now())->count();

    return response()->json([
        'checkIn' => $checkInCount,
        'checkOut' => $checkOutCount,
    ]);
}
public function getCheckInCheckOutData()
{
    $totalCheckIns = Booking::where('check_in', '<=', now())->count();
    $totalCheckOuts = Booking::where('check_out', '<=', now())->count();
    $totalReservations = $totalCheckIns + $totalCheckOuts;

    // Calculate percentages
    $checkInPercentage = $totalReservations > 0 ? ($totalCheckIns / $totalReservations) * 100 : 0;
    $checkOutPercentage = $totalReservations > 0 ? ($totalCheckOuts / $totalReservations) * 100 : 0;

    return response()->json([
        'checkInPercentage' => $checkInPercentage,
        'checkOutPercentage' => $checkOutPercentage,
    ]);
}
public function getBookedRoomData()
{
    $pending = Booking::where('payment_status', 'pending')->count(); // Replace 'status' with your actual column name
    $paid = Booking::where('payment_status', 'paid')->count();
    
    // Total bookings
    $total = $pending + $paid;

    return response()->json([
        'pending' => $pending,
        'paid' => $paid,
        'total' => $total, 
    ]);
}

public function getLatestBookings(){
    $latestBookings = Booking::with(['user','room'])
    ->latest()
    ->take(4) // limit to 4 bookings
    ->get(); 

    return response()->json($latestBookings);
}

public function getPaymentStatus()
{
    $pendingPayments = Booking::where('payment_status', 'pending')
        ->with(['user', 'room'])
        ->orderBy('created_at', 'desc') // Order by latest
        ->take(4) // Limit to the latest 4
        ->get();

        // fetch canceled payments based on canceled_at
    $canceledPayments = Booking::whereNotNull( 'canceled_at')
        ->with(['user', 'room'])
        ->orderBy('canceled_at', 'desc') // Order by latest
        ->take(4) // Limit to the latest 4
        ->get();

    return response()->json([
        'pendingPayments' => $pendingPayments,
        'canceledPayments' => $canceledPayments,
    ]);
}



}


