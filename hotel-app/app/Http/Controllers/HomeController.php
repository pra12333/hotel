<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RecentActivity;
use App\Models\Notification;

class HomeController extends Controller
{
    public function showhomepage(){
        $userName = Auth::user();

       // delete the expired bookings
       Booking::where('payment_status','pending')
             ->where('expires_at','<=',now())
             ->delete();

        // fetch pending bookings for the logged-in user
        $pendingBookings = Booking::where('user_id',$userName->id)
        ->where('payment_status','pending')
        ->where('expires_at','>',now())
        ->get();

        $notifications = Notification::where('user_id',Auth::id())
                    ->where('status','unread')
                    ->orderBy('created_at','desc')
                    ->get();

        $recentActivities = RecentActivity::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->limit(5) // Fetch the latest 5 activities
                        ->get();

        // fetch recommended rooms
       
        $recommendedRooms = Room::where('is_recommended', true)->limit(3)->get();

        // fetch the latest 5 past bookings for the logged in user
        $pastBookings = Booking::where('user_id',$userName->id)
        ->where('payment_status','paid')
        ->orderBy('check_out','desc')
        ->take(5)
        ->get();
        \Log::info('Past Bookings:', $pastBookings->toArray());
        return view('user.homepage',compact('userName','pendingBookings','pastBookings','recommendedRooms','recentActivities','notifications'));
    }
    
    public function searchRooms(Request $request)
    {
        \Log::info('Search Request Received:', $request->all());
    
        try {
            $query = Room::query();
    
            // Filter by room type (case-insensitive match for "Triple Room")
            if ($request->filled('room_type')) {
                $query->where('room_type', 'like', '%' . $request->room_type . '%');
                \Log::info('Filtered by room type:', ['room_type' => $request->room_type]);
            }
    
            // Filter by amenities (AC/Non-AC, Pickup)
            if ($request->filled('is_ac')) {
                $query->where('ac', $request->ac);
                \Log::info('Filtered by AC:', ['ac' => $request->ac]);
            }
            if ($request->filled('free_pickup')) {
                $query->where('pickup', $request->pickup);
                \Log::info('Filtered by Pickup:', ['pickup' => $request->pickup]);
            }
    
            // Filter by price range
            if ($request->filled('price_min') && $request->filled('price_max')) {
                $query->whereBetween('price', [(int)$request->price_min, (int)$request->price_max]);
                \Log::info('Filtered by Price Range:', [
                    'price_min' => $request->price_min,
                    'price_max' => $request->price_max,

                    // validation rules
                ]);
            }
    
            // Get filtered results
            $rooms = $query->get();
    
            // Log the final results
            \Log::info('Final Search Results:', ['rooms' => $rooms]);
    
            return response()->json([
                'success' => true,
                'data' => $rooms,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in searchRooms:', ['message' => $e->getMessage()]);
    
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.',
            ]);
        }
    }
    
   
}
