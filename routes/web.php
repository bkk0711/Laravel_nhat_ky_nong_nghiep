<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HTXController;
use App\Http\Controllers\NongDanController;
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
Route::get('edit_htx/{id}', [AdminController::class, 'edit_htx']);
Route::get('del_htx/{id}', [AdminController::class, 'x_htx']);
Route::post('edit_htx', [AdminController::class, 'p_edit_htx']);

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

Route::get('edit_chu_nhiem', [AdminController::class, 'edit_chu_nhiem']);
Route::post('edit_chu_nhiem', [AdminController::class, 'p_edit_chu_nhiem']);

// HTX
Route::post('import_loai_vattu', [HTXController::class, 'import_loai_vattu']);

Route::get('add_member', [HTXController::class, 'add_member']);
Route::post('add_member', [HTXController::class, 'p_add_member']);
Route::get('ds_member', [HTXController::class, 'ds_member']);

Route::get('htx_vattu', [HTXController::class, 'vattu']);
Route::post('htx_vattu', [HTXController::class, 'addvattu']);
Route::get('htx_vattu/{id}', [HTXController::class, 'edit_vattu']);
Route::get('htx_loai_vattu', [HTXController::class, 'loai_vattu']);
Route::get('xoa_vattu/{id}', [HTXController::class, 'xoa_vattu']);

Route::get('giong', [HTXController::class, 'giong']);
Route::post('giong', [HTXController::class, 'p_giong']);

Route::get('thua', [HTXController::class, 'thua']);
Route::post('thua', [HTXController::class, 'p_thua']);

Route::get('mua_vu', [HTXController::class, 'mua_vu']);
Route::post('mua_vu', [HTXController::class, 'p_mua_vu']);

Route::post('htx_loai_vattu', [HTXController::class, 'add_loai_vattu']);
Route::post('edit_vattu', [HTXController::class, 'p_edit_vattu']);
Route::post('htx_ncc_vattu', [HTXController::class, 'add_ncc_vattu']);
Route::get('htx_ncc_vattu', [HTXController::class, 'ncc_vattu']);
Route::get('/xoa_loai_vattu/{id}', [HTXController::class, 'del_loai_vattu']);
Route::get('htx_xuat_vattu', [HTXController::class, 'xuat_vat_tu']);
Route::post('htx_xuat_vattu', [HTXController::class, 'p_xuat_vat_tu']);
Route::get('xuat_giong', [HTXController::class, 'xuat_giong']);
Route::post('xuat_giong', [HTXController::class, 'p_xuat_giong']);

// Nong dan
Route::get('nhan_vat_tu', [NongDanController::class, 'nhan_vat_tu']);
Route::get('su_dung_vat_tu', [NongDanController::class, 'su_dung_vat_tu']);
Route::post('su_dung_vat_tu', [NongDanController::class, 'p_su_dung_vat_tu']);
Route::get('lam_dat', [NongDanController::class, 'lam_dat']);
Route::post('lam_dat', [NongDanController::class, 'p_lam_dat']);

Route::get('xuong_giong', [NongDanController::class, 'xuong_giong']);
Route::post('xuong_giong', [NongDanController::class, 'p_xuong_giong']);


// Route::get('/nhan_vat_tu', [NongDanController::class, '']);

// Route::post('vattu', [AdminController::class, 'addvattu']);
//Route::post('login', 'AdminController@checklogin');
