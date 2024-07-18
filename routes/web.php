<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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


Route::get('/dashboard', function () {
    return view('frontend.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::get('user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');

});

require __DIR__.'/auth.php';

Route::get('/', [UserController::class, 'index'])->name('home');

Route::middleware(['auth','role:admin'])->group(function(){

    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    Route::controller(PropertyTypeController::class)->group(function(){
        Route::get('all/types', 'AllTypes')->name('all.types');
        Route::get('add/type', 'AddType')->name('add.type');
        Route::post('store/type', 'StoreType')->name('store.type');
    });

});

Route::middleware(['auth','role:agent'])->group(function(){

    Route::get('agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');

});

Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
