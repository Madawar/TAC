<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\FinanceActivityController;
use App\Http\Controllers\FlightScheduleController;
use App\Http\Controllers\FlightServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
Route::resource('flight', FlightController::class)->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');
Route::resource('carrier', CarrierController::class)->middleware('auth');
Route::resource('schedule', FlightScheduleController::class)->middleware('auth');
Route::resource('service', FlightServiceController::class)->middleware('auth');
Route::resource('finance', FinanceActivityController::class)->middleware('auth');
Route::resource('profile', ProfileController::class)->middleware('auth');
