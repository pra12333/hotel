<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;



class AdminReviewController extends Controller
{
    // Fetch all reviews
    // public function index()
    // {
    //     $reviews = Review::with(['user', 'room'])->get();
    //     return view('admin.admindashboard', compact('reviews'));
    // }

    // Update a review
    public function update(Request $request, $id)
    {
        $request->validate([
            'review' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::findOrFail($id);
        $review->update([
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return response()->json(['success' => true, 'message' => 'Review updated successfully']);
    }

    // Delete a review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json(['success' => true, 'message' => 'Review deleted successfully']);
    }
}
