<?php

use App\Http\Controllers\CustomInternController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TalentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'index'])->name('home')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth', 'prevent-back'])->group(function () {
    Route::resource('/intern', InternController::class);
    Route::post('/intern', [InternController::class, 'import']);
    Route::get('/exportIntern', [InternController::class, 'export']);
    Route::post('/selected-intern', [CustomInternController::class, 'deleteAll']);

    Route::resource('/staff', StaffController::class);
    Route::post('/staff', [StaffController::class, 'import']);
    Route::get('/exportStaff', [StaffController::class, 'export']);

    Route::resource('/talent', TalentController::class);
    Route::get('/exportTalent', [TalentController::class, 'export']);
});