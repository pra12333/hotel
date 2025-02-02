<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    // public function fetchHomepageNotifications()
    // {
    //     // calculate the cut off time (48hours)
    //      $cutoffTime = now()->subHours(48);
    //     // Fetch notifications for the logged-in user
    //     $notifications = Notification::where('user_id', auth()->id())
    //         ->whereIn('type', ['booking_confirmed', 'checkout_reminder', 'pending_payment'])
    //         ->where('status', 'unread')
    //         ->where('created_at','>=',$cutoffTime)
    //         ->orderBy('created_at', 'desc')
    //         ->take(5)
    //         ->get();

    //         logger('Notifications fetched:', $notifications->toArray());

    //     return response()->json(['notifications' => $notifications]);
    // }
    public function fetchHomepageNotifications()
{
    $notifications = Notification::where('user_id', Auth::id())
        ->where('status', 'unread')
        ->orderBy('created_at', 'desc')
        ->take(5) // Limit to the last 5 notifications
        ->get();

        \Log::info('Fetched Notifications:', $notifications->toArray());


    return response()->json(['notifications' => $notifications]);
}


    public function markAsRead($id)
{
    try {
        $reminder = Notification::findOrFail($id); // Ensure notification exists

        // Update the status to 'read'
        $reminder->update(['status' => 'read']);

        \Log::info('Reminder marked as read:', [
            'id' => $id,
            'user_id' => $reminder->user_id,
            'updated_at' => $reminder->updated_at
        ]);

        return response()->json(['success' => true, 'message' => 'Reminder marked as read.']);
    } catch (\Exception $e) {
        \Log::error('Error marking reminder as read:', [
            'error' => $e->getMessage(),
            'id' => $id
        ]);

        return response()->json(['success' => false, 'message' => 'Failed to mark reminder as read.']);
    }
}


}
