<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RoomBed\Index;
use App\Http\Livewire\RoomBed\View;
use App\Http\Livewire\Bed\BedIndex;
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
])->name('bed.')->prefix('bed')->group(function () {
    Route::get('/bed_index', BedIndex::class)->name('bed_index');
    //Route::get('/view/{id}', View::class)->name('view');
});
