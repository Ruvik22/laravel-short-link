<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\TinyLinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BlogController::class, 'index']);


// Use throttle middleware for creating links
Route::middleware(['throttle:20,1'])->group(function () {
    // Create tiny link
    Route::post('/create-tiny-link', [TinyLinkController::class, 'store'])->name('createTinyLink');

    // Show real link from tiny link
    Route::get('/{slug}', [TinyLinkController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
