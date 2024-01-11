<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RoomBed\Index;
use App\Http\Livewire\RoomBed\View;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::middleware([
    'auth:sanctum', 'role:admin',
    config('jetstream.auth_session'),
    'verified',
])->name('room.')->prefix('room')->group(function () {
    Route::get('/index', Index::class)->name('index');
    Route::get('/view/{id}', View::class)->name('view');
});
