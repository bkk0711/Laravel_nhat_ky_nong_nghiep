<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HTXController;
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
Route::post('vattu', [AdminController::class, 'addvattu']);
Route::get('loai_vattu', [AdminController::class, 'loai_vattu']);
Route::post('loai_vattu', [AdminController::class, 'add_loai_vattu']);
Route::get('/del_loai_vattu/{id}', [AdminController::class, 'del_loai_vattu']);
Route::post('ncc_vattu', [AdminController::class, 'add_ncc_vattu']);
Route::get('ncc_vattu', [AdminController::class, 'ncc_vattu']);
Route::get('ds_htx', [AdminController::class, 'ds_htx']);
Route::post('ds_htx', [AdminController::class, 'p_htx']);
Route::get('chu_nhiem', [AdminController::class, 'chu_nhiem']);
Route::post('chu_nhiem', [AdminController::class, 'p_chu_nhiem']);

Route::post('import_loai_vattu', [HTXController::class, 'import_loai_vattu']);

Route::get('add_member', [HTXController::class, 'add_member']);
Route::post('add_member', [HTXController::class, 'p_add_member']);
Route::get('ds_member', [HTXController::class, 'ds_member']);

Route::get('htx_vattu', [HTXController::class, 'vattu']);
Route::post('htx_vattu', [HTXController::class, 'addvattu']);
Route::get('htx_loai_vattu', [HTXController::class, 'loai_vattu']);
Route::post('htx_loai_vattu', [HTXController::class, 'add_loai_vattu']);
Route::post('htx_ncc_vattu', [HTXController::class, 'add_ncc_vattu']);
Route::get('htx_ncc_vattu', [HTXController::class, 'ncc_vattu']);
Route::get('/xoa_loai_vattu/{id}', [HTXController::class, 'del_loai_vattu']);
// Route::post('vattu', [AdminController::class, 'addvattu']);
//Route::post('login', 'AdminController@checklogin');
