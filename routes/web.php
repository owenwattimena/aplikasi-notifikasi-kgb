<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UnitKerjaController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('/mail', function () {
    return view('auth.mail-forgot-password');
});
Route::get('/', function () {
    return redirect()->route('login.login');
});
// Route::get('/post-list', function () {
//     return view('web.post-list');
// });
// Route::get('/post', function () {
//     return view('web.post');
// });

Route::middleware(['guest'])->group(function () { 
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.login');
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'postEmail'])->name('forgot-password.postEmail');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
    
    Route::post('/reset-password/{token}', [ForgotPasswordController::class, 'updatePassword'])->name('reset-password.update');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
    Route::put('/dashboard/profile', [ProfileController::class, 'updateProfile'])->name('dashboard.profile.put');
    Route::put('/dashboard/profile/change-password', [ProfileController::class, 'changePassword'])->name('dashboard.profile.password');
    
    Route::prefix('master')->group(function () {
        Route::prefix('unit-kerja')->group(function () {
            Route::get('/', [UnitKerjaController::class, 'index'])->name('unit-kerja');
            Route::get('tambah', [UnitKerjaController::class, 'create'])->name('unit-kerja.create');
            Route::get('ubah/{id}', [UnitKerjaController::class, 'edit'])->name('unit-kerja.edit');
            Route::post('save', [UnitKerjaController::class, 'save'])->name('unit-kerja.save');
            Route::delete('delete/{id}', [UnitKerjaController::class, 'destroy'])->name('unit-kerja.destroy');
        });
        
        Route::prefix('jabatan')->group(function () {
            Route::get('/', [JabatanController::class, 'index'])->name('jabatan');
            Route::get('tambah', [JabatanController::class, 'create'])->name('jabatan.create');
            Route::get('ubah/{id}', [JabatanController::class, 'edit'])->name('jabatan.edit');
            Route::post('save', [JabatanController::class, 'save'])->name('jabatan.save');
            Route::delete('delete/{id}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');
        });
    });
});