<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;


Route::name('user.')->group(function () {
    Route::get('/user/form', function () {
        session()->flush();
        session()->regenerateToken();
        return view('store-user');
    })->name('form');

    Route::post('/user/create', [IndexController::class, 'store'])->name('create');
});