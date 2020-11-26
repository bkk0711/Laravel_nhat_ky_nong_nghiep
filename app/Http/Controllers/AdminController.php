<?php

namespace App\Http\Controllers;


use  DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;

class AdminController extends Controller
{
    public function dashboard()
    {   
        $admin = Session::get('admin');
        if(isset($admin)){
           $user = DB::table('tbl_users')->where('username', $admin)->first();
            return view('admin.dashboard')->with('user', $user);
        }else{
            return redirect('/');
        }
    }

    public function checklogin(Request $request){
        $username = $request->username;
        $password = md5($request->password);
        $result = DB::table('tbl_users')->where('username', $username)->where('password', $password)->first();
        if($result){
            $request->session()->put('admin', $username);
            return redirect('/dashboard');
        }else{
            $request->session()->put('message', 'Sai tên đăng nhập hoặc mật khẩu. Vui lòng nhập lại!');
            return redirect('/');
        }
    }

    public function logout()
    {
        Session::put('admin', null);
        return redirect('/');
    }

    // Vat tu
    public function vattu()
    {   
        return view('admin.vattu');
       
    }
    public function loai_vattu()
    {   
        $loai = DB::table('tbl_loai_vattu')->get();
        return view('admin.loai_vattu')->with('loai', $loai);
       
    }
    public function ncc_vattu()
    {   
        $ncc = DB::table('tbl_nccvt')->get();
        return view('admin.ncc_vattu')->with('ncc', $ncc);
       
    }
    public function add_loai_vattu(Request $request)
    {   
        $loai = $request->loai;
        $data = array();
        $data['loai'] = $loai;
        $check = DB::table('tbl_loai_vattu')->where('loai', $loai)->count();
        if($check == 0){
            DB::table('tbl_loai_vattu')->insert($data);
            Session::put('message', 'Thêm Thành Công');
        }else{
            Session::put('message', 'Đã tồn tại');
        }
       
        return redirect('loai_vattu');
    }
    public function add_ncc_vattu(Request $request)
    {   
        $mancc = $request->ma_ncc;
        $tenncc = $request->ten_ncc;
        $diachi = $request->diachi;
        $sdt = $request->sdt;
        $email = $request->email;
        $web = $request->website;
        $data = array();
        $data['MaNCC'] = $mancc;
        $data['TenNCC'] = $tenncc;
        $data['DiaChi'] = isset($diachi) ? $diachi : '';
        $data['SDT'] = isset($sdt) ? $sdt : '';
        $data['Website'] = isset($web) ? $web : '';
        $check = DB::table('tbl_nccvt')->where('MaNCC', $mancc)->count();
        if($check == 0){
            DB::table('tbl_nccvt')->insert($data);
            Session::put('message', 'Thêm Thành Công');
        }else{
            Session::put('message', 'Đã tồn tại');
        }
        return redirect('ncc_vattu');
    }
}
