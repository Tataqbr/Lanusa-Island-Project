<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookingController;


Route::get('/', [GuestController::class, 'Home'])->name('home');

Route::get('destinations', [GuestController::class, 'destinations'])->name('destinations');

Route::get('resort-detail/{slug}', [GuestController::class, 'resortDetail'])->name('resort-detail');

Route::get('membership-detail/{slug}', [GuestController::class, 'membershipDetail'])->name('membership-detail');

Route::get('memberships', [GuestController::class, 'memberships'])->name('memberships');

Route::get('about-us', function () {
    return view('guest.about-us');
})->name('about-us');

Route::get('contact', function () {
    return view('guest.contact');
})->name('contact');

// Registration
Route::post('/payment/pay', [PaymentController::class, 'pay'])->name('payment.pay');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/fail', [PaymentController::class, 'fail'])->name('payment.fail');
Route::post('/payment/upload-proof', [PaymentController::class, 'uploadProof'])->name('payment.upload_proof');
Route::post('/payment/notification', [PaymentController::class, 'midtransCallback']);
Route::post('/xendit/callback', [PaymentController::class, 'xenditCallback']);

Route::get('/payment/download-certificate/{order_id}', [App\Http\Controllers\PaymentController::class, 'downloadCertificate'])
    ->name('payment.download_certificate');

// Booking 
Route::post('/booking/verify', [BookingController::class, 'verifyCode'])->name('booking.verify');
Route::get('/booking/checkout/{resort_id}/{user_id}', [BookingController::class, 'checkout'])->name('booking.checkout');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

Route::get('/booking/success/{order_id}', [BookingController::class, 'success'])->name('booking.success');
Route::get('/booking/download-contract/{order_id}', [BookingController::class, 'downloadContract'])->name('booking.download_contract');

// Route::get('login', function () {
//     return view('guest.login');
// })->name('login');

// Route::get('register', function () {
//     return view('guest.register');
// })->name('register');

Route::get('faq', function () {
    return view('guest.faq');
})->name('faq');

Route::get('download-faq', [GuestController::class, 'DownloadFaqBrochure'])->name('download-faq');

Route::get('privacy', function () {
    return view('guest.privacy');
})->name('privacy');

Route::get('terms', function () {
    return view('guest.terms');
})->name('terms');

Route::get('concierge', function () {
    return view('guest.concierge');
})->name('concierge');

Route::get('collections', [GuestController::class, 'collections'])->name('collections');

Route::get('elite', function () {
    return view('guest.elite');
})->name('elite');

Route::get('legal', function () {
    return view('guest.legal');
})->name('legal');


// Super Admin Route
Route::get('Dashboard Super Admin', [SuperAdminController::class, 'Dashboard'])->name('dashboard-super-admin');
// Booking Routes - TETAP SAMA
Route::post('/accept-booking/{id}', [SuperAdminController::class, 'acceptBooking'])->name('accept-booking');
Route::post('/reject-booking/{id}', [SuperAdminController::class, 'rejectBooking'])->name('reject-booking');
Route::post('/confirm-payment/{id}', [SuperAdminController::class, 'confirmPayment'])->name('confirm-payment');

// User Request Routes - DIUBAH (hapus route modal terpisah)
Route::post('/create-user/{id}', [SuperAdminController::class, 'createUser'])->name('create-user');
Route::delete('/delete-user-request/{id}', [SuperAdminController::class, 'deleteUserRequest'])->name('delete-user-request');

// Admin Request Routes - DIUBAH (hapus route modal terpisah)
Route::post('/update-admin-request/{id}', [SuperAdminController::class, 'updateAdminRequest'])->name('update-admin-request');
Route::post('/approve-admin/{id}', [SuperAdminController::class, 'approveAdmin'])->name('approve-admin');
Route::post('/disapprove-admin/{id}', [SuperAdminController::class, 'disapproveAdmin'])->name('disapprove-admin');
Route::post('/approve-all-admins', [SuperAdminController::class, 'approveAllAdmins'])->name('approve-all-admins');

// Gateways
Route::delete('/delete-gateway/{id}', [PaymentController::class, 'deleteGateway'])->name('delete-gateway');
Route::post('/edit-payment-gateway/{id}', [PaymentController::class, 'editGateway'])->name('edit-payment-gateway');
Route::post('/gateway-toggle-status/{id}', [PaymentController::class, 'toggleStatus'])->name('gateway-toggle-status');

Route::get('/payment/success', [PaymentController::class, 'paymentSuccessPage'])->name('payment.success');
Route::get('/payment/failed', [PaymentController::class, 'paymentFailedPage'])->name('payment.failed');

Route::post('/payment/initiate', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');
Route::post('/payment/success', [PaymentController::class, 'handlePaymentSuccess'])->name('payment.success');
Route::post('/payment/midtrans-callback', [PaymentController::class, 'midtransCallback'])->name('payment.midtrans-callback');
Route::post('/payment/xendit-callback', [PaymentController::class, 'xenditCallback'])->name('payment.xendit-callback');

Route::get('/payment/xendit/success/{transaction_id}', [PaymentController::class, 'xenditSuccess'])->name('payment.xendit.success');
Route::get('/payment/xendit/failed/{transaction_id}', [PaymentController::class, 'xenditFailed'])->name('payment.xendit.failed');

Route::post('/payment/bank-transfer', [PaymentController::class, 'bankTransferPayment'])->name('payment.bank-transfer');

Route::get('/transactions', [PaymentController::class, 'transactionHistory'])->name('transactions.history');

// Booking Routes
Route::post('/booking/initiate', [PaymentController::class, 'initiateResortBooking'])->name('booking.initiate');
Route::post('/booking/success', [PaymentController::class, 'handleBookingSuccess'])->name('booking.success');
Route::post('/booking/pending', [PaymentController::class, 'handleBookingPending'])->name('booking.pending');
Route::post('/booking/error', [PaymentController::class, 'handleBookingError'])->name('booking.error');

// Xendit Callback Routes
Route::post('/xendit/booking-callback', [PaymentController::class, 'handleXenditCallback'])->name('booking.xendit.callback');
Route::get('/booking/xendit/success/{transaction_id}', [PaymentController::class, 'xenditBookingSuccess'])->name('booking.xendit.success');
Route::get('/booking/xendit/failed/{transaction_id}', [PaymentController::class, 'xenditBookingFailed'])->name('booking.xendit.failed');

Route::post('/booking/bank-transfer', [PaymentController::class, 'bookingBankTransfer'])->name('booking.bank-transfer');

// Destinations Page
Route::get('Manage Destinations', [SuperAdminController::class, 'Destinations'])->name('destinations-super-admin');
Route::post('Add Region', [SuperAdminController::class, 'AddRegion'])->name('add-region');
Route::post('Edit Region/{id}', [SuperAdminController::class, 'EditRegion'])->name('edit-region');
Route::delete('Delete Region/{id}', [SuperAdminController::class, 'DeleteRegion'])->name('delete-region');

Route::post('Add Destination', [SuperAdminController::class, 'AddDestination'])->name('add-destination');
Route::post('Edit Destination/{id}', [SuperAdminController::class, 'EditDestination'])->name('edit-destination');
Route::delete('Delete Destination/{id}', [SuperAdminController::class, 'DeleteDestination'])->name('delete-destination');

// Resorts Page
Route::get('Manage Resorts', [SuperAdminController::class, 'Resorts'])->name('resorts-super-admin');
Route::post('Add Resort', [SuperAdminController::class, 'AddResort'])->name('add-resort');
Route::post('Edit Resort/{id}', [SuperAdminController::class, 'EditResort'])->name('edit-resort');
Route::delete('Delete Resort/{id}', [SuperAdminController::class, 'DeleteResort'])->name('delete-resort');


// Admins Page
Route::get('Manage Admins', [SuperAdminController::class, 'Admins'])->name('admins-super-admin');
Route::post('Add Admin', [SuperAdminController::class, 'AddAdmin'])->name('add-admin');
Route::post('Edit Admin/{id}', [SuperAdminController::class, 'EditAdmin'])->name('edit-admin');
Route::delete('Delete Admin/{id}', [SuperAdminController::class, 'DeleteAdmin'])->name('delete-admin');


// Users Page
Route::get('Manage Users', [SuperAdminController::class, 'Users'])->name('users-super-admin');
Route::post('Edit Not Paid/{id}', [SuperAdminController::class, 'EditNotPaid'])->name('edit-not-paid');
Route::delete('Delete Not Paid/{id}', [SuperAdminController::class, 'DeleteNotPaid'])->name('delete-not-paid');
Route::post('Edit Member/{id}', [SuperAdminController::class, 'EditMember'])->name('edit-member');
Route::delete('Delete Member/{id}', [SuperAdminController::class, 'DeleteMember'])->name('delete-member');

// Membership Page

/// Reservation Routes
Route::get('Manage Membership', [SuperAdminController::class, 'manageMembership'])->name('membership-super-admin');
Route::post('add-reservation', [SuperAdminController::class, 'addReservation'])->name('add-reservation');
Route::post('edit-reservation/{id}', [SuperAdminController::class, 'editReservation'])->name('edit-reservation');
Route::delete('delete-reservation/{id}', [SuperAdminController::class, 'deleteReservation'])->name('delete-reservation');

// Available Space Routes
Route::post('add-available-space', [SuperAdminController::class, 'addAvailableSpace'])->name('add-available-space');
Route::post('edit-available-space/{id}', [SuperAdminController::class, 'editAvailableSpace'])->name('edit-available-space');
Route::delete('delete-available-space/{id}', [SuperAdminController::class, 'deleteAvailableSpace'])->name('delete-available-space');


// Reports Page
Route::get('Manage Reports', [SuperAdminController::class, 'Report'])->name('reports-super-admin');
Route::delete('delete-admin-report/{id}', [SuperAdminController::class, 'deleteAdminReport'])->name('delete-admin-report');
// Di web.php
Route::post('/approve-registration', [SuperAdminController::class, 'approveRegistration'])->name('approve-registration');
Route::delete('/delete-registration/{id}', [SuperAdminController::class, 'deleteRegistration'])->name('delete-registration');


// Contents Page
Route::get('Manage Contents', [SuperAdminController::class, 'Content'])->name('contents-super-admin');
// News Routes
Route::post('/add-news', [SuperAdminController::class, 'addNews'])->name('add-news');
Route::post('/edit-news/{id}', [SuperAdminController::class, 'editNews'])->name('edit-news');
Route::delete('/delete-news/{id}', [SuperAdminController::class, 'deleteNews'])->name('delete-news');

// Plans Routes
Route::post('/add-plan', [SuperAdminController::class, 'addPlan'])->name('add-plan');
Route::post('/edit-plan/{id}', [SuperAdminController::class, 'editPlan'])->name('edit-plan');
Route::delete('/delete-plan/{id}', [SuperAdminController::class, 'deletePlan'])->name('delete-plan');


// Auth
Route::get('Login Super-Admin', [AuthController::class, 'showLoginSAdmin'])->name('login-super-admin');
Route::post('Proccess Login Super-Admin', [AuthController::class, 'loginSAdmin'])->name('proccess-login-super-admin');
Route::post('Logout Super-Admin', [AuthController::class, 'LogoutSAdmin'])->name('logout-super-admin');