<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RecentActivity;

class ReviewController extends Controller
{
    public function showreview($roomId) {

        $room = \App\Models\Room::find($roomId);
        // dd($room);

        if (!$room) {
            abort(404,'Room not found');
        }
        return view('user.review',compact('room'));
    }

    public function store(Request $request)
{
    \Log::info('Request data:', $request->all());

    // Find the room
    $room = \App\Models\Room::find($request->room_id);

    if (!$room) {
        \Log::warning('Room not found', ['room_id' => $request->room_id]);
        return response()->json(['success' => false, 'message' => 'Room not found'], 404);
    }

    // Create RecentActivity
    RecentActivity::create([
        'user_id' => Auth::id(),
        'activity_type' => 'review',
        'description' => 'Wrote a review for: ' . $room->room_type,
    ]);

    \Log::info('RecentActivity created successfully for user', [
        'user_id' => Auth::id(),
        'activity_type' => 'review',
        'description' => 'Wrote a review for: ' . $room->room_type,
    ]);

    // Validate the request
    $request->validate([
        'review' => 'required|string|max:255',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    \Log::info('Request validated');

    // Ensure the user is authenticated
    if (!Auth::check()) {
        return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
    }

    // Log the room_id before saving the review
    \Log::info('Room ID before saving review:', ['room_id' => $request->room_id]);


    try {
        // Save the review
        $review = \App\Models\Review::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id, // Correct syntax here
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        \Log::info('Review created successfully', ['review' => $review]);

        return response()->json(['success' => true, 'message' => 'Review submitted successfully']);
    } catch (\Exception $e) {
        \Log::error("Review submission failed: " . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Failed to submit review'], 500);
    }
}

}

//  public function fetchReviews() {
//     $reviews = Review::with('user:id,name')
//            ->orderBy('created_at','desc')
//            ->get();

//         return response()->json($reviews);
//  }
//     public function updateReview(Request $request,$id) {
//         $review = Review::findOrFail($id);
//         $review->update([
//             'review' => $request->input('review'),
//             'rating' => $request->input('rating'),
//         ]);
//         return response()->json(['message'=>'Review updated successfully']);
//     }

//     public function deleteReview($id) {
//         $review = Review::findOrFail($id);
//         $review->delete();

//         return response()->json(['message' => 'Review deleted successfully']);
//     }

