<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');
Route::get('/about-us', [IndexController::class, 'about'])->name('about')->middleware('auth');

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/list', [ShopController::class, 'index'])->name('index');
    Route::get('/create', [ShopController::class, 'create'])->name('create');
    Route::post('/store', [ShopController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ShopController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ShopController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [ShopController::class, 'destroy'])->name('destroy');
});

// Ro(ute::prefix('customer')->name('customer.')->group(function () {
//     Route::get('/list', [CustomerController::class, 'index'])->name('index');
//     Route::get('/create', [CustomerController::class, 'create'])->name('create');
//     Route::post('/store', [CustomerController::class, 'store'])->name('store');
//     Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
//     Route::put('/update/{id}', [CustomerController::class, 'update'])->name('update');
//     Route::delete('/destroy/{id}', [CustomerController::class, 'destroy'])->name('destroy');
// });

Route::patch('customer/{customer}/restore', [CustomerController::class, 'restore'])->name('customer.restore');
Route::delete('customer/{customer}/delete', [CustomerController::class, 'delete'])->name('customer.delete');
Route::get('customer/{id}/posts', [PostController::class, 'index'])->name('post.index');

Route::resource('customer', CustomerController::class);

Route::resource('student', StudentController::class);
Route::post('student/{student}/courses', [StudentController::class, 'attachCourses'])->name('student.courses.store');

Route::resource('course', CourseController::class);
Route::post('course/{course}/students', [CourseController::class, 'attachStudent'])->name('course.students.store');

require __DIR__.'/settings.php';
