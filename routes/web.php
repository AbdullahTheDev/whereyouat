<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DriverController as AdminDriverController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Driver\DeliveryController as DriverDeliveryController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Driver\ProfileController as DriverProfileController;
use App\Http\Controllers\Driver\TripController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Payment\StripeDeliveryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DeliveryController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GeneralController::class, 'index'])->name('main');

Route::prefix('driver')->middleware(['auth', 'driver'])->group(function () {
    Route::get('/register', function () {
        return view('drivers.auth.register');
    })->name('driver.register');

    Route::get('/dashboard', [DriverController::class, 'index'])->name('driver.dashboard');

    Route::prefix('trips')->group(function () {
        Route::get('/announce', [TripController::class, 'announce'])->name('driver.trips.announce');
        Route::get('/history', [TripController::class, 'history'])->name('driver.trips.history');
    });

    Route::prefix('delivery')->group(function () {
        Route::get('/distance', [DriverDeliveryController::class, 'distanceDelivery'])->name('driver.delivery.distance');
        Route::get('/vicinity', [DriverDeliveryController::class, 'vicinityDelivery'])->name('driver.delivery.vicinity');
        Route::get('/track', [DriverDeliveryController::class, 'trackDelivery'])->name('driver.delivery.track');

        Route::get('/my/deliveries', [DriverDeliveryController::class, 'yourDelivery'])->name('driver.delivery.your');
        Route::get('/my/distance', [DriverDeliveryController::class, 'yourDistanceDelivery'])->name('driver.delivery.distance.your');
        Route::get('/my/vicinity', [DriverDeliveryController::class, 'yourVicinityDelivery'])->name('driver.delivery.vicinity.your');

        Route::post('/distance/accept', [DriverDeliveryController::class, 'distaneDeliveryAccept'])->name('driver.delivery.distance.accept');
        Route::post('/distance/status', [DriverDeliveryController::class, 'distaneDeliveryStatus'])->name('driver.delivery.distance.status');
    
        Route::post('/vicinity/accept', [DriverDeliveryController::class, 'vicinityDeliveryAccept'])->name('driver.delivery.vicinity.accept');
        Route::post('/vicinity/status', [DriverDeliveryController::class, 'vicinityDeliveryStatus'])->name('driver.delivery.vicinity.status');
    
    });

    Route::get('/notifications', function () {
        return view('drivers.notifications');
    })->name('driver.notifications');

    Route::get('/profile', [DriverProfileController::class, 'edit'])->name('driver.profile.edit');
    Route::post('/profile', [DriverProfileController::class, 'update'])->name('driver.profile.update');
    Route::delete('/profile', [DriverProfileController::class, 'destroy'])->name('driver.profile.destroy');
});


Route::prefix('user')->middleware(['auth', 'user'])->group(function () {
    Route::get('/register', function () {
        return view('users.auth.register');
    })->name('user.register');

    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    Route::prefix('delivery')->group(function () {
        Route::get('/distance', [DeliveryController::class, 'distanceDelivery'])->name('user.delivery.distance');
        Route::post('/distance', [DeliveryController::class, 'distanceDeliveryStore'])->name('user.delivery.distance.store');

        Route::get('distance/stripe/{id?}', [StripeDeliveryController::class, 'distanceDeliveryStripe'])->name('user.delivery.distance.stripe');
        Route::post('distance/stripe', [StripeDeliveryController::class, 'distanceDeliveryStripePost'])->name('user.delivery.distance.stripe.post');


        Route::get('/vicinity', [DeliveryController::class, 'vicinityDelivery'])->name('user.delivery.vicinity');
        Route::post('/vicinity', [DeliveryController::class, 'vicinityDeliveryStore'])->name('user.delivery.vicinity.store');

        Route::get('vicinity/stripe/{id?}', [StripeDeliveryController::class, 'vicinityDeliveryStripe'])->name('user.delivery.vicinity.stripe');
        Route::post('vicinity/stripe', [StripeDeliveryController::class, 'vicinityDeliveryStripePost'])->name('user.delivery.vicinity.stripe.post');


        Route::get('/track', [DeliveryController::class, 'trackDelivery'])->name('user.delivery.track');
        Route::get('/track/distance', [DeliveryController::class, 'distanceTrackDelivery'])->name('user.delivery.track.distance');
        Route::get('/track/vicinity', [DeliveryController::class, 'vicinityTrackDelivery'])->name('user.delivery.track.vicinity');

        Route::get('/distance/driver-info/{id}', [DeliveryController::class, 'distanceDriver'])->name('user.delivery.distance.driver');
        Route::get('/vicinity/driver-info/{id}', [DeliveryController::class, 'vicinityDriver'])->name('user.delivery.vicinity.driver');

    });
    Route::get('/notifications', function () {
        return view('users.notifications.index');
    })->name('user.notifications');

    Route::get('/profile', [UserProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('user.profile.destroy');
});


Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/notifications', function () {
        return view('admin.notifications.index');
    })->name('admin.notifications');


    Route::prefix('drivers')->group(function () {
        Route::get('/all', [AdminDriverController::class, 'allDrivers'])->name('admin.drivers.all');
        Route::get('/import', [AdminDriverController::class, 'importDrivers'])->name('admin.drivers.import');
        Route::post('/import', [AdminDriverController::class, 'importDriversPost'])->name('admin.drivers.import.post');
    });

    
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');
});


Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');



Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
