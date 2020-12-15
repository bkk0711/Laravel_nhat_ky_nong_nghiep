<?php

namespace App\Http\Controllers;

use  DB;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\importvt;

session_start();
class HTXController extends Controller
{
    public function dashboard()
    {
        $admin = Session::get('admin');
        if(isset($admin)){
           $user = DB::table('tbl_users')->where('username', $admin)->first();
            return view('htx.dashboard')->with('user', $user);
        }else{
            return redirect('/');
        }
    }
    public function add_member(){
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->get();
        $total = $htx->count();
        return view('htx.add_member')->with('htx', $htx)->with('total', $total);
    }
    public function ds_member(){
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->get();
        $total = $htx->count();
        return view('htx.ds_member')->with('htx', $htx)->with('total', $total);
    }
    public function p_add_member(Request $request){
        $user = $request->user;
        $pass = $request->pass;
        $htx = $request->htx;
        $name = $request->fullname;
        $email = $request->email;
        $sdt = $request->SDT;
        $tk = $request->tai_khoan;
        if(isset($tk)){
            $check_r = DB::table('tbl_users')->where('username', $tk)->first();
            $check = DB::table('tbl_users')->where('username', $tk)->count();
            if($check_r->role < 3){
                Session::put('message', 'Người dùng không hợp lệ');
            }else{
                if($check == 1){
                    $check_htx =  DB::table('tbl_htx_member')->where('id_user', $check_r->id)->where('id_htx', $htx)->count();
                    if($check_htx == 0){
                        $d = array();
                        $d['id_user'] = $check_r->id;
                        $d['id_htx'] = $htx;
                        DB::table('tbl_htx_member')->insert($d);
                        Session::put('message', 'Thông tin được thêm thành công');
                    }else{
                        Session::put('message', 'Thông tin đã tồn tại trên hệ thống');
                    }

                }else{
                    Session::put('message', 'Người dùng không hợp lệ');
                }
            }
        }else if(isset($user) && isset($pass)){
            $check = DB::table('tbl_users')->where('username', $user)->count();
            if($check == 0){
                $data = array();
                $data['username'] = $user;
                $data['password'] = md5($pass);
                $data['name'] = $name;
                $data['email'] = $email;
                $data['sdt'] = $sdt;
                $data['role'] = 3;
                $id = DB::table('tbl_users')->insertGetId($data);
                $d = array();
                $d['id_user'] = $id;
                $d['id_htx'] = $htx;
                DB::table('tbl_htx_member')->insert($d);
                Session::put('message', 'Thông tin được thêm thành công');
            }else{
                Session::put('message', 'Thông tin đã tồn tại trên hệ thống');
            }


        }else{
            Session::put('message', 'Vui lòng điền đầy đủ thông tin');
        }
        return redirect('add_member');
    }
    public function import_loai_vattu(Request $request){
        $file = $request->file;
        $collection = Excel::toCollection(new importvt, $file);
        dd($collection);
        // foreach($collection[0] as $key => $value)
        // {
        //     $url = $value[7];
        //     $cau_hoi = $value[1];
        //     $tl1 = $value[2];
        //     $tl2 = $value[3];
        //     $tl3 = $value[4];
        //     $tl4 = $value[5];
        //     $tl_dung = $value[6];
        //     // echo $cau_hoi;
        //     // echo '<br/>';

        // }

        // return redirect('/de/'.$de);
        // Session::put('message', 'Câu hỏi được <b>Import</b> thành công');
        // Session::put('made', $de);

    }
    public function vattu()
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $loai = DB::table('tbl_loai_vattu')->get();
        $ncc = DB::table('tbl_nccvt')->get();
        $vattu = DB::table('tbl_vattu')->where('id_user', $user->id)->get();
        return view('htx.vattu')->with('loai', $loai)->with('ncc', $ncc)->with('vattu', $vattu);
    }

    public function loai_vattu()
    {
        $loai = DB::table('tbl_loai_vattu')->get();
        return view('htx.loai_vattu')->with('loai', $loai);

    }

    public function ncc_vattu()
    {

        $ncc = DB::table('tbl_nccvt')->get();
        return view('htx.ncc_vattu')->with('ncc', $ncc);

    }
    public function addvattu(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $ten = $request->ten;
        $loai = $request->loai;
        $ncc = $request->ncc;
        $hoatchat = $request->hoatchat;
        $doituong = $request->doituong;
        $hdsd = $request->hdsd;
        if(!empty($request->image)){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $img = Storage::put('images', $request->image);

        }else{
            $img = "";
        }
        $data = array();
        $data['ten'] = isset($ten) ? $ten : '';
        $data['loai'] = isset($loai) ? $loai : '';
        $data['id_ncc']= isset($ncc) ? $ncc : '';
        $data['hoat_chat']= isset($hoatchat) ? $hoatchat : '';
        $data['doi_tuong']= isset($doituong) ? $doituong : '';
        $data['hdsd']= isset($hdsd) ? $hdsd : '';
        $data['img']= isset($img) ? $img : '';
        $data['ngay_nhap']= time();
        $data['donvi']= $request->donvi;
        $data['id_user']= $user->id;
        $check = DB::table('tbl_vattu')->where('ten', $ten)->where('id_user', $user->id)->count();
        if($check == 0){
            DB::table('tbl_vattu')->insert($data);
            Session::put('message', 'Thêm Thành Công');
        }else{
            Session::put('message', 'Đã tồn tại');
        }

        return redirect('htx_vattu');
    }
    public function add_loai_vattu(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $loai = $request->loai;
        $data = array();
        $data['loai'] = $loai;
        $data['id_user'] = $user->id;
        $check = DB::table('tbl_loai_vattu')->where('loai', $loai)->count();
        if($check == 0){
            DB::table('tbl_loai_vattu')->insert($data);
            Session::put('message', 'Thêm Thành Công');
        }else{
            Session::put('message', 'Đã tồn tại');
        }

        return redirect('htx_loai_vattu');
    }

    public function del_loai_vattu($id)
    {
        $check = DB::table('tbl_loai_vattu')->where('id',$id)->first();
        if( $check->id_user == 0 ){
            Session::put('message', 'Không thể xóa');
        }else{
            DB::table('tbl_loai_vattu')->where('id', $id)->delete();
            Session::put('message', 'Xóa Thành Công');
        }

        return redirect('htx_loai_vattu');
    }

    public function add_ncc_vattu(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
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
        $data['Email'] = isset($email) ? $email : '';
        $data['Website'] = isset($web) ? $web : '';
        $data['id_user'] = $user->id;
        $check = DB::table('tbl_nccvt')->where('MaNCC', $mancc)->count();
        if($check == 0){
            DB::table('tbl_nccvt')->insert($data);
            Session::put('message', 'Thêm Thành Công');
        }else{
            Session::put('message', 'Đã tồn tại');
        }
        return redirect('htx_ncc_vattu');
    }

}
