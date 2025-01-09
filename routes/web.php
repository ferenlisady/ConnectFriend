<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AvatarController;

use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('process-payment');
Route::post('/handle-overpayment', [PaymentController::class, 'handleOverpayment'])->name('handle-overpayment');
Route::get('/avatars', [AvatarController::class, 'index'])->name('avatar.index');
Route::get('/set-locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('set-locale');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/top-up', [UserController::class, 'topUpCoin'])->name('topUpCoin');
    Route::post('/avatars/{id}/purchase', [AvatarController::class, 'purchase'])->name('avatar.purchase');
    Route::get('my-avatars', [AvatarController::class, 'myAvatars'])->name('avatar.myAvatar');
    Route::post('set-profile-picture/{avatarId}', [AvatarController::class, 'setProfilePicture'])->name('avatar.setProfilePicture');
    Route::post('avatars/send/{avatarId}/{receiverId}', [AvatarController::class, 'sendAvatar'])->name('avatar.send');
    Route::get('/avatars/received-avatars', [AvatarController::class, 'receivedAvatars'])->name('avatar.received');
    Route::post('/avatars/save/{avatarId}', [AvatarController::class, 'saveAvatar'])->name('avatar.save');
    Route::post('/friend/accept/{requestId}', [FriendController::class, 'accept'])->name('friend.accept');
    Route::post('/friend/decline/{requestId}', [FriendController::class, 'decline'])->name('friend.decline');
    Route::post('/profile/visibility', [ProfileController::class, 'updateVisibility'])->name('profile.visibility');
    Route::post('/add-friend/{receiver_id}', [FriendController::class, 'addFriend'])->name('add.friend');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

