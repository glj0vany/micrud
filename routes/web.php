<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RelacionController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;

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

require __DIR__.'/auth.php';

Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);
Route::get('/dashboard', [RelacionController::class, 'index'])->name('dashboard');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/create-category', [CategoryController::class, 'create'])->name('categories.create');
Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');
