<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\AdminReviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';



Route::get('/rooms', function () {
    return view('user.room-listing');
})->name('rooms');

// Route to display the registration form
Route::get('/register', [AuthController::class, 'showSignupForm'])->name('showregister');

// Route to handle the form submission
Route::post('/register', [AuthController::class, 'signup'])->name('register');



Route::get('/login',[AuthController::class,'signin'])->name('signin');


// Route::post('/register',[AuthController::class,'signup'])->name('register');


Route::get('/set-password', [AuthController::class, 'showPasswordSetupForm']);
Route::post('/set-password', [AuthController::class, 'setPassword']);

// Route to show the password setup form
Route::get('/password-setup/{token}', [AuthController::class, 'showPasswordSetupForm'])->name('password.setup');

Route::get('/login', [AuthController::class, 'signin'])->name('login');

Route::post('/login',[AuthController::class,'login'])->name('login.submit');

Route::get('/homepage',[HomeController::class,'showhomepage'])->name('homepage');

Route::get('/search',[SearchController::class,'showsearch'])->name('search');

Route::get('/payment',[PaymentController::class,'showpayment'])->name('payment');

Route::get('/profile',[ProfileController::class,'showprofile'])->name('profile');

Route::get('/confirmation',[PaymentController::class,'showconfirm'])->name('confirmation');

Route::get('/review/{roomId}',[ReviewController::class,'showreview'])->name('review');

Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::post('/review/{roomId}',[ReviewController::class,'store'])->name('review.store');

Route::post('/process-payment', [PaymentController::class, 'processPayment'])->middleware('auth')->name('payment.process');

Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

Route::get('/search-rooms',[RoomController::class,'search'])->name('search.rooms');
Route::get('/booking', [BookingController::class, 'showBookingStep'])->name('booking.step');
Route::get('/confirmation/{id}', [PaymentController::class, 'showConfirmation'])->name('confirmation');

Route::post('/payment/hold', [PaymentController::class, 'holdPayment'])->name('payment.hold');
Route::get('/check-availability', [BookingController::class, 'showCheckAvailability'])->name('check.availability');
Route::get('/room/details/{room_id}', [RoomController::class, 'showRoomDetails'])->name('room.details');
Route::get('/rooms', [RoomController::class, 'listRooms'])->name('rooms.list')->middleware('auth');

Route::get('/payment/continue/{bookingId}', [PaymentController::class, 'continuePayment'])->name('payment.continue');


Route::post('/booking/cancel/{bookingId}', [PaymentController::class, 'cancelBooking'])->name('booking.cancel');

Route::post('/homepage-search',[HomeController::class,'searchRooms'])->name('homepage.search');
Route::get('/homepage-notifications', [ReminderController::class, 'fetchHomepageNotifications'])->name('homepage.notifications');

// Route::get('/homepage-notifications', function () {
//     $notifications = Notification::where('user_id', Auth::id())
//         ->where('status', 'unread')
//         ->orderBy('created_at', 'desc')
//         ->get();

//     return response()->json(['notifications' => $notifications]);
// });


// Route::get('/admindashboard',[AdminController::class,'showadmin'])->name('admin');

// Route::get('/adminroomregister',[AdminRoomController::class,'register'])->name('register');

// Route::get('/adminupdate',[AdminRoomController::class,'updating'])->name('update');

 //Route::get('/adminview',[AdminRoomController::class,'view'])->name('view');

// Route::get('/modify-booking/{id}',[BookingController::class,'edit'])->name('booking.edit');

// Route::put('/modify-booking/{id}', [BookingController::class, 'update'])->name('booking.update');

Route::post('/reminders/{id}/mark-as-read', [ReminderController::class, 'markAsRead'])->name('reminders.markAsRead');

// Route::post('/rooms/store', [AdminRoomController::class, 'store'])->name('room.store');

 //Route::post('/rooms/update/{id}',[AdminRoomController::class,'update'])->name('room.update');

// Route::delete('/rooms/delete/{id}',[AdminRoomController::class,'destroy'])->name('room.destroy');

// Route::get('/admin/rooms/{id}', [AdminRoomController::class, 'show'])->name('rooms.show');

// Route::get('/admin/rooms/{id}/edit', [AdminRoomController::class, 'edit'])->name('rooms.edit');

// Route::delete('/admin/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');

    // Route::get('/reviews', [ReviewController::class, 'fetchReviews'])->name('admin.reviews.fetch');
    // Route::put('/reviews/{id}', [ReviewController::class, 'updateReview'])->name('admin.reviews.update');
    // Route::delete('/reviews/{id}', [ReviewController::class, 'deleteReview'])->name('admin.reviews.delete');


   
// Route::get('/admin/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews');
// Route::put('/admin/reviews/{id}', [AdminReviewController::class, 'update'])->name('admin.reviews.update');
// Route::delete('/admin/reviews/{id}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');

// Route::get('/admin/dashboard-data', [AdminController::class, 'getDashboardData'])->name('admin.dashboardData');

// Route::get('/admin/dashboard-stats', [AdminController::class, 'getDashboardStats']);

// Route::get('admin/reservationStats',[AdminController::class,'getReservationStats'])->name('admin.reservationStats');


// Route::get('/admin/check-in-check-out-data', [AdminController::class, 'getCheckInCheckOutData'])->name('admin.checkInCheckOutData');


// Route::get('/admin/bookedRoomData', [AdminController::class, 'getBookedRoomData'])->name('admin.bookedRoomData');

// Route::get('/admin/latest-bookings',[AdminController::class,'getLatestBookings'])->name('admin.latestBookings');

// Route::get('/admin/payment-status',[AdminController::class,'getPaymentStatus'])->name('admin.paymentStatus');

// Route::get('/admin/booking-trends',[AdminController::class,'getBookingTrends'])->name('admin.bookingTrends');

// Route::get('admin/revenue-trends',[AdminController::class,'getRevenueTrends'])->name('admin.revenueTrends');


// Group all admin routes under 'auth' and 'admin' middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'showadmin'])->name('admin');

    // Room Management
    Route::get('/room-register', [AdminRoomController::class, 'register'])->name('room-register');
    Route::get('/room-update', [AdminRoomController::class, 'updating'])->name('update');
    Route::get('/room-view', [AdminRoomController::class, 'view'])->name('view');
    Route::post('/rooms/store', [AdminRoomController::class, 'store'])->name('room.store');
    Route::post('/admin/rooms/update/{id}', [AdminRoomController::class, 'update'])->name('room.update');
    Route::get('/rooms/{id}', [AdminRoomController::class, 'show'])->name('rooms.show');
    Route::get('/rooms/{id}/edit', [AdminRoomController::class, 'edit'])->name('rooms.edit');

    // Booking Management
    Route::get('/modify-booking/{id}', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/modify-booking/{id}', [BookingController::class, 'update'])->name('booking.update');

    // Reviews Management
    Route::put('/reviews/{id}', [AdminReviewController::class, 'update'])->name('admin.reviews.update');
    Route::delete('/reviews/{id}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');

    // Admin Dashboard Data
    Route::get('/dashboard-data', [AdminController::class, 'getDashboardData'])->name('admin.dashboardData');
    Route::get('/dashboard-stats', [AdminController::class, 'getDashboardStats'])->name('admin.dashboardStats');
    Route::get('/reservation-stats', [AdminController::class, 'getReservationStats'])->name('admin.reservationStats');

    // Booking & Payment Reports
    Route::get('/check-in-check-out-data', [AdminController::class, 'getCheckInCheckOutData'])->name('admin.checkInCheckOutData');
    Route::get('/booked-room-data', [AdminController::class, 'getBookedRoomData'])->name('admin.bookedRoomData');
    Route::get('/latest-bookings', [AdminController::class, 'getLatestBookings'])->name('admin.latestBookings');
    Route::get('/payment-status', [AdminController::class, 'getPaymentStatus'])->name('admin.paymentStatus');
    Route::get('/booking-trends', [AdminController::class, 'getBookingTrends'])->name('admin.bookingTrends');
    Route::get('/revenue-trends', [AdminController::class, 'getRevenueTrends'])->name('admin.revenueTrends');

    // Reminders
    Route::post('/reminders/{id}/mark-as-read', [ReminderController::class, 'markAsRead'])->name('reminders.markAsRead');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/adminview', [AdminRoomController::class, 'view'])->name('view');
    Route::post('/rooms/update/{id}',[AdminRoomController::class,'update'])->name('room.update');
    Route::delete('/rooms/delete/{id}',[AdminRoomController::class,'destroy'])->name('room.destroy');
    Route::get('/admin/rooms/{id}/edit', [AdminRoomController::class, 'edit'])->name('rooms.edit');

Route::delete('/admin/rooms/{id}', [AdminRoomController::class, 'destroy'])->name('rooms.destroy');
    

});