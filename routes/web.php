<?php

use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\SchoolYearController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
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
    return view('login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard.index');
    });
    Route::resource('users', UserController::class);
    Route::resource('school-year', SchoolYearController::class);
    Route::resource('classes', ClassesController::class);
    Route::resource('subjects', SubjectController::class);
});