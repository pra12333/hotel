<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Validator;

class AdminRoomController extends Controller
{
    public function register(){
        $roomTypes = Room::Select('room_type')->distinct()->get();
        return view('admin.adminroomregister',compact('roomTypes'));
    }

    public function updating(){
        return view('admin.update');
    }

    public function show($id) {
        $room = Room::findOrFail($id);
        return view('admin.show',compact('room'));
    }

    public function view(){
        $rooms = Room::all(); // fetch all rooms
        return view('admin.view',compact('rooms'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_type' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'available_from' => 'required|date',
            'available_to' => 'required|date|after_or_equal:available_from',
            'available_rooms' => 'required|integer|min:1',
            'free_pickup' => 'required|in:yes,no',
            'is_ac' => 'required|in:yes,no',
            'is_recommended' => 'required|in:yes,no',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Save the uploaded image to `images` directory
        $imagePath = $request->file('image')->store('images', 'public');
    
        // Save the room data
        Room::create([
            'room_type' => $request->room_type,
            'description' => $request->description,
            'price' => $request->price,
            'available_from' => $request->available_from,
            'available_to' => $request->available_to,
            'available_rooms' => $request->available_rooms,
            'free_pickup' => $request->free_pickup === 'yes',
            'is_ac' => $request->is_ac === 'yes',
            'is_recommended' => $request->is_recommended === 'yes',
            'image' => $imagePath, // Always save the full path including 'images/'
        ]);
    
        return back()->with('success', 'Room registered successfully!');
    }

    public function update(Request $request ,$id) {
        
        $room = Room::findOrFail($id);
        $room->update([
            'room_type' => $request->room_type,
            'description' => $request->description,
            'price' => $request->price,
            'available_from' => $request->available_from,
            'available_to' => $request->available_to,
            'free_pickup'=>$request->free_pickup,
            'is_ac' => $request->is_ac,
            'is_recommended' => $request->is_recommended,
            'image' => $room->image,
        ]);
        return response()->json(['message' => 'Room updated successfully']);
    }
    public function destroy($id) {
        $room = Room::findOrFail($id);
        $room->delete();

        return response()->json(['message'=>'Room deleted successfully',
        'redirect' => route('view')
    ]);
    }
    public function edit($id)
{
    $room = Room::findOrFail($id);
    $roomTypes = Room::Select('room_type')->distinct()->get();
    return view('admin.update', compact('room','roomTypes'));
}


}


// public function store(Request $request)
// {
//     \Log::info($request->all());
// \Log::info($request->file('image'));

//     // Validate the request
//     $validator = Validator::make($request->all(), [
//         'room_type' => 'required|string|max:255',
//         'description' => 'required|string',
//         'price' => 'required|numeric|min:0',
//         'available_from' => 'required|date',
//         'available_to' => 'required|date|after_or_equal:available_from',
//         'available_rooms' => 'required|integer|min:1',
//         'free_pickup' => 'required|in:yes,no',
//         'is_ac' => 'required|in:yes,no',
//         'is_recommended' => 'required|in:yes,no',
//         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ]);

//     if ($validator->fails()) {
//         return back()->withErrors($validator)->withInput();
//     }

//     // Handle file upload
//     $imagePath = $request->file('image')->store('rooms', 'public');

//     // Create the room record
//     Room::create([
//         'room_type' => $request->room_type,
//         'description' => $request->description,
//         'price' => $request->price,
//         'available_from' => $request->available_from,
//         'available_to' => $request->available_to,
//         'available_rooms' => $request->available_rooms,
//         'free_pickup' => $request->free_pickup === 'yes',
//         'is_ac' => $request->is_ac === 'yes',
//         'is_recommended' => $request->is_recommended === 'yes',
//         'image' => $imagePath,
//     ]);

//     return back()->with('success', 'Room registered successfully!');
// }
   
// }

