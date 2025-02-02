<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'check_in' => 'nullable|date|before:check_out',
            'check_out' => 'nullable|date|after:check_in',
            'room_type' => 'nullable|string',
            'keywords' => 'nullable|string',
            'free_pickup' => 'nullable|in:yes,no',
            'is_ac' => 'nullable|in:0,1',
            'price_range' => 'nullable|string',
        ]);
    
        $rooms = Room::query();
    
        if ($request->filled('keywords')) {
            $rooms->where(function ($query) use ($request) {
                $query->where('room_type', 'like', '%' . $request->keywords . '%')
                      ->orWhere('description', 'like', '%' . $request->keywords . '%');
            });
        }
    
        if ($request->filled('check_in')) {
            $rooms->whereDate('available_from', '<=', $request->check_in);
        }
    
        if ($request->filled('check_out')) {
            $rooms->whereDate('available_to', '>=', $request->check_out);
        }
    
        if ($request->filled('room_type')) {
            $rooms->where('room_type', $request->room_type);
        }
    
        if ($request->filled('is_ac')) {
            $rooms->where('is_ac', $request->is_ac);
        }
    
        if ($request->filled('price_range')) {
            $priceRange = explode('-', $request->price_range);
            if (count($priceRange) === 2) {
                $rooms->whereBetween('price', [trim($priceRange[0]), trim($priceRange[1])]);
            }
        }
    
        if ($request->filled('free_pickup')) {
            $rooms->where('free_pickup', $request->free_pickup === 'yes' ? 1 : 0);
        }
    
        if ($request->filled('number_of_rooms')) {
            $rooms->where('available_rooms', '>=', $request->number_of_rooms);
        }
    
        // Apply pagination
        $paginatedRooms = $rooms->paginate(10);
    
        // Return the response
        return response()->json($paginatedRooms);
    }
    public function showRoomDetails($room_id)
{
    // $roomId = $request->query('room_id');
    $room = Room::findOrFail($room_id);

    return view('user.room_details', compact('room'));
}

public function listRooms()
{
    // Fetch all rooms or apply any filters as needed
    $rooms = Room::paginate(6); // display 6 rooms per page

    return view('user.room-listing', compact('rooms'));
}

}