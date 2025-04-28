<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // CRUD User (akses hanya untuk Administrator)
        Route::middleware(['role:Administrator'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('leave_types', LeaveTypeController::class);


    });
});

Route::middleware(['auth'])->group(function () {

    Route::get('leave_requests', [LeaveRequestController::class, 'index'])->name('leave_requests.index');
    Route::get('leave_requests/create', [LeaveRequestController::class, 'create'])->name('leave_requests.create');
    Route::post('leave_requests/store', [LeaveRequestController::class, 'store'])->name('leave_requests.store');
    Route::post('leave_requests/{leaveRequest}/approve', [LeaveRequestController::class, 'approve'])->name('leave_requests.approve');
    Route::post('leave_requests/{leaveRequest}/reject', [LeaveRequestController::class, 'reject'])->name('leave_requests.reject');

    Route::post('export_excel',[ExportController::class,'export'])->name('export_excel');
    
    Route::get('export', [ExportController::class, 'index'])->name('excel.export_import');
    
    Route::post('/get-fields', [ExportController::class, 'getFields'])->name('get-fields');
    Route::post('import_excel',[ExportController::class,'import'])->name('import_excel');
    Route::get('export/download/{filename}', [ExportController::class, 'downloadExport'])->name('export.download');
});

require __DIR__.'/auth.php';
