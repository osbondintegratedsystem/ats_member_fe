<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('coming-soon');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/change-password', function () {
    return view('auth.change-password');
});

Route::get('/checkin', function () {
    return view('checkin');
});

Route::get('/members', function () {
    return view('members.index');
});

Route::get('/recap', function () {
    return view('recap.index');
});

Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
            return view('admin.users');
        }
        );

        Route::get('/clubs', function () {
            return view('admin.clubs');
        }
        );    });
