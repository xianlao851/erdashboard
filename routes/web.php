<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Livewire\RoomBed\Index;
//use App\Http\Livewire\RoomBed\View;
use App\Http\Livewire\Bed\BedIndex;
use App\Http\Livewire\Dash\Index;
use App\Http\Livewire\Room\RoomIndex;
use App\Http\Livewire\User\UserList;
use App\Http\Livewire\Dash\SecondMonitor;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Index::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/charts', Index::class)->name('charts');

Route::get('/dashboard_monitoring', SecondMonitor::class)->name('dashboard_monitoring');

Route::middleware([
    'auth:sanctum', 'role:admin',
    config('jetstream.auth_session'),
    'verified',
])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/user_list', UserList::class)->name('user_list');
    Route::get('/room', RoomIndex::class)->name('room');
    //Route::get('/view/{id}', View::class)->name('view');
});
