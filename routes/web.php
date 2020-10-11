<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UniversityController;

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

Auth::routes();

// Admin START -------------------------------------
Route::group(['prefix'=>'admin'], function() {
    Route::group(['middleware'=>'admin.guest:admin'], function() {
        Route::view('login','admin.login')->name('admin.login');
        Route::post('login',[AdminController::class, 'login'])->name('admin.auth');
    });
    Route::group(['middleware'=>'admin.auth'], function() {
        Route::view('dashboard','admin.dashboard')->name('admin.dashboard');
        Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
// Admin END ----------------------------------------
// University START ---------------------------------
Route::group(['prefix'=>'university'], function() {
    Route::group(['middleware'=>'university.guest:university'], function() {
        Route::view('login','university.login')->name('university.login');
        Route::post('login',[UniversityController::class, 'login'])->name('university.auth');
    });
    Route::group(['middleware'=>'university.auth'], function() {
        Route::view('dashboard','university.dashboard')->name('university.dashboard');
        Route::post('logout', [UniversityController::class, 'logout'])->name('university.logout');
    });
});
// University END -----------------------------------


Route::get('/home', [HomeController::class, 'index'])->name('home');
