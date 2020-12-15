<?php
namespace App\Http\Controllers;

use  DB;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests;
session_start();
class AdminController extends Controller
{
    public function dashboard()
    {
        $admin = Session::get('admin');
        if(isset($admin)){
           $user = DB::table('tbl_users')->where('username', $admin)->first();
           if($user->role == 1){
            return view('admin.dashboard')->with('user', $user);
           }else if($user->role == 2){
            return view('htx.dashboard')->with('user', $user);
           }else{
            return view('nongdan.dashboard')->with('user', $user);
           }

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
        $loai = DB::table('tbl_loai_vattu')->get();
        $ncc = DB::table('tbl_nccvt')->get();
        $vattu = DB::table('tbl_vattu')->get();
        return view('admin.vattu')->with('loai', $loai)->with('ncc', $ncc)->with('vattu', $vattu);

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
    public function addvattu(Request $request)
    {
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

        $check = DB::table('tbl_vattu')->where('ten', $ten)->count();
        if($check == 0){
            DB::table('tbl_vattu')->insert($data);
            Session::put('message', 'Thêm Thành Công');
        }else{
            Session::put('message', 'Đã tồn tại');
        }

        return redirect('vattu');
    }
    public function add_loai_vattu(Request $request)
    {
        $loai = $request->loai;
        $data = array();
        $data['loai'] = $loai;
        $data['id_user'] = 0;
        $check = DB::table('tbl_loai_vattu')->where('loai', $loai)->count();
        if($check == 0){
            DB::table('tbl_loai_vattu')->insert($data);
            Session::put('message', 'Thêm Thành Công');
        }else{
            Session::put('message', 'Đã tồn tại');
        }

        return redirect('loai_vattu');
    }
    public function del_loai_vattu($id)
    {
        DB::table('tbl_loai_vattu')->where('id', $id)->delete();
        Session::put('message', 'Xóa Thành Công');
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
        $data['Email'] = isset($email) ? $email : '';
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

    public function ds_htx()
    {
        $chu_nhiem = DB::table('tbl_users')->where('role', 2)->get();
        $htx = DB::table('tbl_htx')->get();
        return view('admin.htx')->with('htx', $htx)->with('chu_nhiem', $chu_nhiem);

    }
    public function p_htx(Request $request)
    {
        $ten = $request->ten;
        $mst = $request->mst;
        $cn = $request->cn;
        $diachi = $request->diachi;
        $sdt = $request->phone;
        if($ten != '' && $mst != '' && $cn !=''){
            $data = array();
            $data['ten'] = $ten;
            $data['ma_so_thue'] = $mst;
            $data['chu_nhiem'] = $cn;
            $data['dia_chi'] = $diachi;
            $data['so_dien_thoai'] = $sdt;
            $check = DB::table('tbl_htx')->where('ten', $ten)->where('ma_so_thue', $mst)->count();
            if($check == 0){
                DB::table('tbl_htx')->insert($data);
                Session::put('message', 'Thông tin được thêm thành công');
            }else{
                Session::put('message', 'Thông tin đã tồn tại trên hệ thống');
            }
        }else{
            Session::put('message', 'Vui lòng điền đầy đủ thông tin');
        }
        return redirect('ds_htx');

    }

    public function chu_nhiem()
    {
        $htx = DB::table('tbl_users')->where('role', 2)->get();
        return view('admin.chunhiem')->with('user', $htx);

    }
    public function p_chu_nhiem(Request $request)
    {
        $ten = $request->ten;
        $user = $request->user;
        $pass = $request->pass;
        $email = $request->email;
        $phone = $request->phone;
        if($ten != '' && $user !='' && $pass !=''){
            $data = array();
            $data['username'] = $user;
            $data['password'] = md5($pass);
            $data['name'] = $ten;
            $data['email'] = $email;
            $data['sdt'] = $phone;
            $data['role'] = 2;
            $check = DB::table('tbl_users')->where('username', $user)->count();
            if($check == 0){
                DB::table('tbl_users')->insert($data);
                Session::put('message', 'Thông tin được thêm thành công');
            }else{
                Session::put('message', 'Thông tin đã tồn tại trên hệ thống');
            }



        }else{
            Session::put('message', 'Vui lòng điền đầy đủ thông tin');
        }

        return redirect('chu_nhiem');

    }

}
