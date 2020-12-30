<?php

namespace App\Http\Controllers;

use  DB;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\importvt;
use Illuminate\Support\Facades\Redirect;

session_start();
class NongDanController extends Controller
{
    public function lam_dat()
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $lam_dat = DB::table('tbl_log_lamdat')->where('id_user', $user->id)->get();
        return view('nongdan.lam_dat')->with('lamdat', $lam_dat);
    }
    public function p_lam_dat(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $ngay = $request->ngay;
        $note = $request->note;
        if($ngay != ''){
            if(strtotime(date("Y-m-d")) >= strtotime($ngay)){


            $data = array();
            $data['ngay'] = $ngay;
            $data['note'] = $note;
            $data['id_user'] = $user->id;
            DB::table('tbl_log_lamdat')->insert($data);
            Session::put('message', 'Thêm thành công');
        }else{
            Session::put('message', 'Ngày không hợp lệ');

        }

        }else{
            Session::put('message', 'Vui lòng điền đầy đủ thông tin');
        }
        return redirect('lam_dat');
    }
    public function nhan_vat_tu()
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();

        $vattu = DB::table('tbl_xuat_vattu')->where('id_nongdan', $user->id)->get();
        $giong = DB::table('tbl_xuat_giong')->where('id_nongdan', $user->id)->get();

        return view('nongdan.nhan_vattu')->with('vattu', $vattu)->with('giong', $giong);
    }
    public function su_dung_vat_tu()
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $vattus = DB::table('tbl_xuat_vattu')->where('id_nongdan', $user->id)->get();
        $vattu = DB::table('tbl_log_vattu')->where('id_user', $user->id)->get();

       return view('nongdan.su_dung_vat_tu')->with('vattu', $vattu)->with('vattus', $vattus)->with('id_u', $user->id);
    }

    public function p_su_dung_vat_tu(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $vattu = $request->vattu;
        $ngay = $request->ngay;
        $so_luong = $request->so_luong;
        $check = DB::table('tbl_xuat_vattu')->where('id', $vattu)->where('id_nongdan', $user)->first();
        $sl = DB::table('tbl_log_vattu')->where('id_user', $user->id)->where('id_vattu', $vattu)->sum('so_luong');


        if($ngay != ''){
            if(strtotime(date("Y-m-d")) >= strtotime($ngay)){
                if(($check->so_luong - ($so_luong + $sl)) < 0  ){
                    Session::put('message', 'Số lượng không đủ');
                }else{
                    $data = array();
                    $data['ngay'] = $ngay;
                    $data['id_vattu'] = $check->id_vattu;
                    $data['id_user'] = $user->id;
                    $data['so_luong'] = $so_luong;

                    DB::table('tbl_log_vattu')->insert($data);
                    Session::put('message', 'Thêm thành công');
                }
        }else{
            Session::put('message', 'Ngày không hợp lệ');

        }

        }else{
            Session::put('message', 'Vui lòng điền đầy đủ thông tin');
        }
        return redirect('su_dung_vat_tu');
    }

    public function xuong_giong()
    {

        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $giongs = DB::table('tbl_xuat_giong')->where('id_nongdan', $user->id)->get();
        $giong = DB::table('tbl_log_giong')->where('id_user', $user->id)->get();

        return view('nongdan.xuong_giong')->with('giongs', $giongs)->with('giong', $giong)->with('id_u', $user->id);
    }

    public function p_xuong_giong(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $giong = $request->giong;
        $ngay = $request->ngay;
        $so_luong = $request->so_luong;

        $check = DB::table('tbl_xuat_giong')->where('id_giong', $giong)->where('id_nongdan', $user->id)->first();
        $sl = DB::table('tbl_log_giong')->where('id_user', $user->id)->where('id_giong', $giong)->sum('so_luong');


        if($ngay != ''){
            if(strtotime(date("Y-m-d")) >= strtotime($ngay)){
                if(($check->so_luong - ($so_luong + $sl)) < 0  ){
                    Session::put('message', 'Số lượng không đủ');
                }else{
                    $data = array();
                    $data['ngay'] = $ngay;
                    $data['id_giong'] = $check->id;
                    $data['id_user'] = $user->id;
                    $data['so_luong'] = $so_luong;

                    DB::table('tbl_log_giong')->insert($data);
                    Session::put('message', 'Thêm thành công');
                }
        }else{
            Session::put('message', 'Ngày không hợp lệ');

        }

        }else{
            Session::put('message', 'Vui lòng điền đầy đủ thông tin');
        }
        return redirect('xuong_giong');
    }



}
