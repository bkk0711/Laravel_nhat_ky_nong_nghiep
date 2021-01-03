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
            return view('admin.dashboard')->with('user', $user->id);
           }else if($user->role == 2){
            $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
            return view('htx.dashboard')->with('user', $user->id)->with('htx', $htx->id);
           }else{

            return view('nongdan.dashboard')->with('user', $user->id);
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
        if($ten != '' && $user !='' && $pass !='' && $email != '' && $phone != ''){
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

    public function edit_htx($id)
    {
        $chu_nhiem = DB::table('tbl_users')->where('role', 2)->get();
        $htx = DB::table('tbl_htx')->where('id', $id)->first();
        return view('admin.edit_htx')->with('htx', $htx)->with('chu_nhiem', $chu_nhiem);

    }
    public function p_edit_htx(Request $request)
    {
        $id = $request->id;
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
            if($check == 1){
                DB::table('tbl_htx')->where('id', $id)->update($data);
                Session::put('message', 'Thông tin được cập nhật thành công');
            }else{
                Session::put('message', 'HTX không tồn tại');
            }
        }else{
            Session::put('message', 'Vui lòng điền đầy đủ thông tin');
        }
        return redirect('ds_htx');

    }
    public function x_htx($id)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        if($user->role == 1){
            $check = DB::table('tbl_htx')->where('id', $id)->count();
            if($check == 1){
                DB::table('tbl_htx')->where('id', $id)->delete();

                DB::table('tbl_mua_vu')->where('id_htx', $id)->delete();

                DB::table('tbl_loai_vattu')->where('id_htx', $id)->delete();
                DB::table('tbl_nccvt')->where('id_htx', $id)->delete();
                DB::table('tbl_htx_member')->where('id_htx', $id)->delete();
                $vt = DB::table('tbl_vattu')->where('id_htx', $id)->get();
                foreach ($vt as $v) {
                    DB::table('tbl_log_vattu')->where('id_vattu', $v->id)->delete();
                    $xvt = DB::table('tbl_xuat_vattu')->where('id_vattu', $v->id)->get();
                    foreach ($xvt as $x) {
                        DB::table('tbl_log_xuat_vattu')->where('id_xuat', $x->id)->delete();
                    }
                    DB::table('tbl_xuat_vattu')->where('id_htx', $id)->delete();
                    DB::table('tbl_vattu')->where('id_htx', $id)->delete();
                }
                $gs = DB::table('tbl_giong')->where('id_htx', $id)->get();
                foreach ($gs as $g) {
                    DB::table('tbl_log_giong')->where('id_giong', $g->id)->delete();
                    $xg = DB::table('tbl_xuat_giong')->where('id_giong', $g->id)->get();
                    foreach ($xg as $x) {
                        DB::table('tbl_log_xuat_giong')->where('id_xuat', $x->id)->delete();
                    }
                    DB::table('tbl_xuat_giong')->where('id_htx', $id)->delete();
                    DB::table('tbl_giong')->where('id_htx', $id)->delete();
                }

                Session::put('message', 'Xóa thành công');

            }
        }
        return redirect('ds_htx');

    }
    public function edit_chu_nhiem($id)
    {
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        $chu_nhiem = DB::table('tbl_users')->where('id', $id)->first();
        if($users->role == 1){
            if($chu_nhiem->role == 2 ){
        return view('admin.edit_chu_nhiem')->with('chu_nhiem', $chu_nhiem);
    }else{
        Session::put('message', 'Bạn không có quyền chỉnh sửa');
        return redirect('chu_nhiem');

    }
    }else{
        Session::put('message', 'Bạn không có quyền chỉnh sửa');
        return redirect('chu_nhiem');

    }


    }
    public function x_chu_nhiem($id)
    {
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        if($users->role == 1){
        $check = DB::table('tbl_users')->where('id', $id)->count();
        if($check > 0){
            DB::table('tbl_users')->where('id', $id)->delete();
            $d = array();
            $d['chu_nhiem'] = null;
            DB::table('tbl_htx')->where('chu_nhiem', $id)->update($d);
            Session::put('message', 'Xoá thành công');
        }else{
            Session::put('message', 'Người dùng không tồn tại');
        }
    }else{
        Session::put('message', 'bạn không có quyền xóa');
    }
        return redirect('chu_nhiem');

    }
    public function p_edit_chu_nhiem(Request $request)
    {
        $name = $request->ten;
        $user = $request->user;
        $pass = $request->pass;
        $email = $request->email;
        $sdt = $request->phone;
        $id = $request->id;
        $check = DB::table('tbl_users')->where('id', $id)->count();
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        $cn = DB::table('tbl_users')->where('id', $id)->first();
        if($users->role == 1){
            if($cn->role == 2){
        if($check > 0){
            $data = array();
            $data['name'] = $name;
            $data['username'] = $user;
            $data['email'] = $email;
            $data['sdt'] = $sdt;
            if($pass){
                $data['password'] = md5($pass);
            }
            DB::table('tbl_users')->where('id', $id)->update($data);
            Session::put('message', 'Cập nhật thành công');
        }else{
            Session::put('message', 'Không hợp lệ');

        }
    }else{
        Session::put('message', 'Bạn không có quyền chỉnh sửa');
    }
    }else{
        Session::put('message', 'Bạn không có quyền chỉnh sửa');
    }
        return redirect('chu_nhiem');
    }
    public function ds_nong_dan()
    {
        $nd = DB::table('tbl_users')->where('role', 3)->get();
        return view('admin.ds_nong_dan')->with('nongdan', $nd);

    }
    public function edit_nong_dan($id)
    {
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        $nd = DB::table('tbl_users')->where('id', $id)->first();
        if($users->role == 1){
            if($nd->role == 3){
        return view('admin.edit_nong_dan')->with('nd', $nd);
    }else{

        Session::put('message', 'Bạn không có quyền chỉnh sửa');
        return redirect('ds_nong_dan');
    }
    }else{

        Session::put('message', 'Bạn không có quyền chỉnh sửa');
        return redirect('ds_nong_dan');
    }


    }
    public function x_nong_dan($id)
    {
        $check = DB::table('tbl_users')->where('id', $id)->count();
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        if($users->role == 1){
        if($check > 0){
            DB::table('tbl_users')->where('id', $id)->delete();
            DB::table('tbl_htx_member')->where('id_user', $id)->delete();
            Session::put('message', 'Xoá thành công');
        }else{
            Session::put('message', 'Người dùng không tồn tại');
        }
    }else{
        Session::put('message', 'bạn không có quyền xóa');
    }
        return redirect('ds_nong_dan');

    }
    public function p_edit_nong_dan(Request $request)
    {
        $name = $request->ten;
        $user = $request->user;
        $pass = $request->pass;
        $email = $request->email;
        $sdt = $request->phone;
        $id = $request->id;
        $check = DB::table('tbl_users')->where('id', $id)->count();
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        $nd = DB::table('tbl_users')->where('id', $id)->first();
        if($users->role == 1){
            if($nd->role == 3){
        if($check > 0){
            $data = array();
            $data['name'] = $name;
            $data['username'] = $user;
            $data['email'] = $email;
            $data['sdt'] = $sdt;
            if($pass){
                $data['password'] = md5($pass);
            }
            DB::table('tbl_users')->where('id', $id)->update($data);
            Session::put('message', 'Cập nhật thành công');
        }else{
            Session::put('message', 'Không hợp lệ');

        }
    }else{
        Session::put('message', 'bạn không có quyền chỉnh sửa');
    }
    }else{
        Session::put('message', 'bạn không có quyền chỉnh sửa');
    }
        return redirect('ds_nong_dan');
    }

    public function ds_giong()
    {
        $giong = DB::table('tbl_giong')->get();
        return view('admin.ds_giong')->with('giong', $giong);

    }

    public function admin_info()
    {
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        return view('admin.info')->with('u', $users);


    }

    public function p_admin_info(Request $request)
    {
        $name = $request->ten;
        $pass = $request->pass;
        $email = $request->email;
        $sdt = $request->phone;
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
            $data = array();
            if($name){
                $data['name'] = $name;
            }
            if($email){
                $data['email'] = $email;
            }
            if($sdt){
                $data['sdt'] = $sdt;
            }
            if($pass){
                $data['password'] = md5($pass);
            }
            if($data){
            DB::table('tbl_users')->where('username', $admin)->update($data);
            Session::put('message', 'Cập nhật thành công');
            }
            if($user->role == 1){
                return redirect('admin_info');
               }else if($user->role == 2){
                return redirect('cn_info');
               }else if($user->role == 3){
                return redirect('nd_info');
               }else{
                return redirect('/');
               }

    }

}
