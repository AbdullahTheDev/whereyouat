<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Driver\TripController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DeliveryController;
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

Route::prefix('driver')->group(function () {
    Route::get('/register', function () {
        return view('drivers.auth.register');
    })->name('driver.register');

    Route::get('/dashboard', [DriverController::class, 'index'])->name('driver.dashboard');

    Route::prefix('trips')->group(function () {
        Route::get('/announce', [TripController::class, 'announce'])->name('driver.trips.announce');
        Route::get('/history', [TripController::class, 'history'])->name('driver.trips.history');
    });
});

Route::prefix('user')->group(function () {
    Route::get('/register', function () {
        return view('generalUsers.auth.register');
    })->name('user.register');

    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    Route::prefix('delivery')->group(function () {
        Route::get('/distance', [DeliveryController::class, 'distanceDelivery'])->name('user.delivery.distance');
        Route::get('/vicinity', [DeliveryController::class, 'vicinityDelivery'])->name('user.delivery.vicinity');
        Route::get('/track', [DeliveryController::class, 'trackDelivery'])->name('user.delivery.track');
    });
});


Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});



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
