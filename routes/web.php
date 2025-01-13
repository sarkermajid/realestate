<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\AmenitieController;
use App\Http\Controllers\Backend\PropertyController;
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

    Route::controller(AdminController::class)->group(function(){
        Route::get('admin/dashboard','AdminDashboard')->name('admin.dashboard');
        Route::get('admin/logout','AdminLogout')->name('admin.logout');
        Route::get('admin/profile','AdminProfile')->name('admin.profile');
        Route::post('admin/profile/update','AdminProfileUpdate')->name('admin.profile.update');
        Route::get('admin/change/password','AdminChangePassword')->name('admin.change.password');
        Route::post('admin/update/password','AdminUpdatePassword')->name('admin.update.password');
    });


    Route::controller(PropertyTypeController::class)->group(function(){
        Route::get('all/types', 'AllTypes')->name('all.types');
        Route::get('add/type', 'AddType')->name('add.type');
        Route::post('store/type', 'StoreType')->name('store.type');
        Route::get('edit/type/{id}', 'EditType')->name('edit.type');
        Route::post('update/type', 'UpdateType')->name('update.type');
        Route::get('delete/type/{id}', 'DeleteType')->name('delete.type');
    });

    Route::controller(AmenitieController::class)->group(function(){
        Route::get('all/amenitie', 'AllAmenitie')->name('all.amenitie');
        Route::get('add/amenitie', 'AddAmenitie')->name('add.amenitie');
        Route::post('store/amenitie', 'StoreAmenitie')->name('store.amenitie');
        Route::get('edit/amenitie/{id}', 'EditAmenitie')->name('edit.amenitie');
        Route::post('update/amenitie', 'UpdateAmenitie')->name('update.amenitie');
        Route::get('delete/amenitie/{id}', 'DeleteAmenitie')->name('delete.amenitie');
    });

    Route::controller(PropertyController::class)->group(function(){
        Route::get('all/property', 'AllProperty')->name('all.property');
        Route::get('add/property', 'AddProperty')->name('add.property');
        Route::post('store/property', 'StoreProperty')->name('store.property');
        Route::get('edit/property/{id}', 'EditProperty')->name('edit.property');
        Route::post('update/property', 'UpdateProperty')->name('update.property');
        Route::get('delete/property/{id}', 'DeleteProperty')->name('delete.property');
        Route::post('update/property/thumbnail', 'UpdatePropertyThumbnail')->name('update.property.thumbnail');
        Route::post('update/property/multiimage', 'UpdatePropertyMultiimage')->name('update.property.multiimage');
        Route::get('delete/property/multiimage/{id}', 'DeletePropertyMultiimage')->name('delete.property.multiimage');
    });

});

Route::middleware(['auth','role:agent'])->group(function(){

    Route::get('agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');

});

Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
