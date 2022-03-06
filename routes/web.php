<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::controller(LoginController::class)->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('login', 'index')->name('login');
    });
    Route::post('auth', 'auth')->name('auth');
    Route::get('logout', 'logout')->name('logout');
});
Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('admin.dashboard');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('employee', 'index')->name('admin.employee');
        Route::post('employee/datatable', 'dtEmployee')->name('admin.employee.dt');
        Route::post('employee/save', 'store')->name('admin.employee.store');
        Route::get('employee/{nik}/detail', 'empDetail')->name('admin.employee.detail');
        Route::put('employee/{nik}/update', 'update')->name('admin.employee.update');
        Route::get('employee/get_colors', 'empColors')->name('admin.employee.color');
        Route::delete('employee/{nik}/delete', 'destroy')->name('admin.employee.destroy');
    
        Route::get('user', 'indexUser')->name('admin.user');
        Route::post('user/datatable', 'dtUser')->name('admin.user.dt');
        Route::put('user/{nik}/reset_password', 'userPassword')->name('admin.user.password');
    });
    
    Route::controller(ScheduleController::class)->group(function () {
        Route::get('picket', 'index')->name('admin.picket');
        // Route::post('picket/datatable', 'dtPicket')->name('admin.picket.dt');
        // Route::put('picket/{id}/update', 'update')->name('admin.picket.update');
        Route::get('picket/generate', 'createPicket')->name('admin.picket.generate');
    });
    
    Route::controller(EventController::class)->group(function () {
        Route::get('event', 'index')->name('admin.event');
        Route::post('event/datatable', 'dtEvent')->name('admin.event.dt');
        Route::get('event/{id}/detail', 'detail')->name('admin.event.detail');
        Route::post('event/save', 'store')->name('admin.event.store');
        Route::put('event/{id}/update', 'update')->name('admin.event.update');
        Route::delete('event/{id}/delete', 'destroy')->name('admin.event.destroy');
        Route::post('event/generate', 'createEvent')->name('admin.event.generate');
    });
});