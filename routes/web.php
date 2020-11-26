<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers;
use App\Http\Controllers\AdminController;
use Illuminate\Http\RedirectResponse;


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
Route::post('login', [AdminController::class, 'checklogin']);
Route::get('dashboard', [AdminController::class, 'dashboard']);
Route::get('logout', [AdminController::class, 'logout']);
Route::get('vattu', [AdminController::class, 'vattu']);
Route::get('loai_vattu', [AdminController::class, 'loai_vattu']);
Route::post('loai_vattu', [AdminController::class, 'add_loai_vattu']);
Route::post('ncc_vattu', [AdminController::class, 'add_ncc_vattu']);
Route::get('ncc_vattu', [AdminController::class, 'ncc_vattu']);
//Route::post('login', 'AdminController@checklogin');
