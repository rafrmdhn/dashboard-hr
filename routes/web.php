<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\CustomInternController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\UserListController;

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

Route::get('/fdashboard', [DashboardController::class, 'index'])->name('home')->middleware('auth');

Route::get('/flogin', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/flogin', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth', 'prevent-back'])->group(function () {
    Route::resource('/intern', InternController::class);
    Route::post('/intern-import', [InternController::class, 'import']);
    Route::get('/exportIntern', [InternController::class, 'export']);
    Route::delete('/selected-intern', [CustomInternController::class, 'deleteAll']);

    Route::resource('/staff', StaffController::class);
    Route::post('/staff-import', [StaffController::class, 'import']);
    Route::get('/exportStaff', [StaffController::class, 'export']);

    Route::resource('/talent', TalentController::class);
    Route::get('/exportTalent', [TalentController::class, 'export']);

    Route::resource('/brand', BrandController::class);

    Route::resource('/agency', AgencyController::class);

    Route::get('/edit-profile', [ProfileController::class, 'index']);

    Route::resource('/users-list', UserListController::class);

    Route::resource('/kinerja-intern', PerformanceController::class);

    Route::resource('/kinerja-staff', IndicatorController::class);

    Route::resource('/earnings', EarningController::class);
    
    Route::resource('/spendings', SpendingController::class);

    Route::get('/fregistrasi', [TalentController::class, 'page']);
    Route::put('/fregistrasi/{talent}', [TalentController::class, 'updateForm']);
});

Route::get('/registrasi-talent', function(){
    return redirect('/form/498c62cf2582c9ef765d1154b0a64032');
});
Route::get('/form/498c62cf2582c9ef765d1154b0a64032', [TalentController::class, 'registrasi']);
Route::post('/form/498c62cf2582c9ef765d1154b0a64032', [TalentController::class, 'form']);