<?php

use App\Http\Controllers\Admin\DashboardController;
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
    Route::get('login', 'index')->name('login');;
    Route::post('auth', 'auth');
    Route::get('logout', '')->name('logout');
});

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

    Route::get('user', 'index')->name('admin.user');
    // Route::post('user/save', 'userStore')->name('admin.user.store');
    // Route::put('user/{nik}/reset_password', 'userPassword')->name('admin.user.password');
});

Route::controller(ScheduleController::class)->group(function () {
    Route::get('schedule', 'index')->name('admin.schedule');
});