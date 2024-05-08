<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\BulkActionController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\CustomInternController;
use App\Http\Controllers\DependantDropdownController;
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

Route::middleware(['role_or_permission:master', 'prevent-back'])->group(function () {
    Route::post('/intern-import', [InternController::class, 'import']);
    Route::get('/exportIntern', [InternController::class, 'export']);
    Route::delete('/bulk-action', [BulkActionController::class, 'deleteAll']);
    Route::post('/staff-import', [StaffController::class, 'import']);
    Route::get('/exportStaff', [StaffController::class, 'export']);
    Route::get('/exportTalent', [TalentController::class, 'export']);
    Route::get('/exportBrand', [BrandController::class, 'export']);
    Route::get('/exportAgency', [AgencyController::class, 'export']);    
});

Route::middleware(['auth', 'prevent-back'])->group(function () {
    Route::resource('/edit-profile', ProfileController::class);
    Route::resource('/kinerja-intern', PerformanceController::class)->parameters(["kinerja-intern" => 'performance']);
    Route::resource('/kinerja-staff', IndicatorController::class)->parameters(["kinerja-staff" => 'indicator']);
    Route::get('/getAgencies', [DependantDropdownController::class, 'getAgencies']);
    Route::get('/getBrands', [DependantDropdownController::class, 'getBrands']);
    
    // Route for return regencies by province_id
    Route::get('/getRegencies/{province_id}', [DependantDropdownController::class, 'getRegencies']);
    Route::get('/getDistricts/{regency_id}', [DependantDropdownController::class, 'getDistricts']);
    Route::get('/getVillages/{district_id}', [DependantDropdownController::class, 'getVillages']);
});

Route::middleware('role_or_permission:view data')->group(function () {
    Route::resource('/intern', InternController::class);
    Route::resource('/staff', StaffController::class);
    Route::resource('/talent', TalentController::class);
    Route::resource('/brand', BrandController::class);
    Route::resource('/agency', AgencyController::class);
    Route::get('/fregistrasi', [TalentController::class, 'page']);
    Route::put('/fregistrasi/{talent}', [TalentController::class, 'updateForm']);
});

Route::middleware('role_or_permission:view users')->group(function () {
    Route::resource('/users-list', UserListController::class)->parameters(["users-list" => 'user']);
});

Route::middleware('role_or_permission:view spendings')->group(function () {
    Route::resource('/spendings', SpendingController::class);
});

Route::middleware('role_or_permission:view earnings')->group(function () {
    Route::resource('/earnings', EarningController::class);
});

Route::get('/registrasi-talent', function(){
    return redirect('/form/498c62cf2582c9ef765d1154b0a64032');
})->name('registrasi-talent');
Route::get('/form/498c62cf2582c9ef765d1154b0a64032', [TalentController::class, 'registrasi']);
Route::post('/form/498c62cf2582c9ef765d1154b0a64032', [TalentController::class, 'form']);