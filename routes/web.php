<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RecapController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClubController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([\App\Http\Middleware\ApiAuthenticated::class])->group(function () {
    Route::get('/checkin', [CheckinController::class, 'index'])->name('checkin');
    Route::post('/checkin', [CheckinController::class, 'checkIn']);
    Route::post('/checkout', [CheckinController::class, 'checkOut']);

    Route::get('/members', [MemberController::class, 'index'])->name('members');
    Route::post('/members', [MemberController::class, 'store']);
    Route::get('/members/{id}', [MemberController::class, 'show']);

    Route::get('/recap', [RecapController::class, 'index'])->name('recap');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class)->except(['create', 'edit', 'show']);
        Route::resource('clubs', ClubController::class)->except(['create', 'edit', 'show']);
    });
});
