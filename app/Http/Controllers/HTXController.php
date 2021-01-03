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

                if($check == 1){
                    if($check_r->role < 3){
                        Session::put('message', 'Người dùng không hợp lệ');
                    }else{
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
                }
                }else{
                    Session::put('message', 'Người dùng không hợp lệ');
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
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $loai = DB::table('tbl_loai_vattu')->where('id_htx', $htx->id)->get();
        $ncc = DB::table('tbl_nccvt')->where('id_htx', $htx->id)->get();
        $vattu = DB::table('tbl_vattu')->where('id_htx', $htx->id)->get();
        return view('htx.vattu')->with('loai', $loai)->with('ncc', $ncc)->with('vattu', $vattu);
    }

    public function loai_vattu()
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $loai = DB::table('tbl_loai_vattu')->where('id_htx', $htx->id)->get();
        return view('htx.loai_vattu')->with('loai', $loai);

    }

    public function ncc_vattu()
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $ncc = DB::table('tbl_nccvt')->where('id_htx', $htx->id)->get();
        return view('htx.ncc_vattu')->with('ncc', $ncc);

    }
    public function addvattu(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
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
        $data['id_htx']= $htx->id;
        $data['so_luong'] = $request->so_luong;
        $data['don_gia'] = $request->don_gia;
        $check = DB::table('tbl_vattu')->where('ten', $ten)->where('id_htx', $htx->id)->count();
        if($check == 0){
            DB::table('tbl_vattu')->insert($data);
            Session::put('message', 'Thêm Thành Công');
        }else{
            Session::put('message', 'Đã tồn tại');
        }

        return redirect('htx_vattu');
    }
    public function p_edit_vattu(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();

        $ten = $request->ten;
        $loai = $request->loai;
        $ncc = $request->ncc;
        $hoatchat = $request->hoatchat;
        $doituong = $request->doituong;
        $hdsd = $request->hdsd;
        if($ten !='' && $loai !='' && $ncc !='' ){
        $check = DB::table('tbl_vattu')->where('id', $request->id)->where('id_htx', $htx->id)->count();
        $checku = DB::table('tbl_vattu')->where('id', $request->id)->first();
        if($check == 0 || ($checku->id_htx != $htx->id) ){
            return redirect('htx_vattu');

        }else{


        $data = array();
        $data['ten'] = isset($ten) ? $ten : null;
        $data['loai'] = isset($loai) ? $loai : null;
        $data['id_ncc']= isset($ncc) ? $ncc : null;
        $data['hoat_chat']= isset($hoatchat) ? $hoatchat : null;
        $data['doi_tuong']= isset($doituong) ? $doituong : null;
        $data['hdsd']= isset($hdsd) ? $hdsd : null;
        if(!empty($request->image)){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $data['img'] = Storage::put('images', $request->image);

        }

        $data['ngay_nhap']= time();
        $data['so_luong'] = $request->so_luong;
        $data['don_gia'] = $request->don_gia;
            DB::table('tbl_vattu')->where('id', $request->id)->update($data);
            Session::put('message', 'Sửa Thành Công');


            return redirect('htx_vattu');
    }
    }else{
        return redirect('htx_vattu');
        Session::put('message', 'điền đầy đủ nội dung');
    }

    }
    public function edit_vattu($id)
    {

        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $loai = DB::table('tbl_loai_vattu')->where('id_htx', $htx->id)->get();
        $ncc = DB::table('tbl_nccvt')->where('id_htx', $htx->id)->get();
        $vattu = DB::table('tbl_vattu')->where('id', $id)->first();
        $check = DB::table('tbl_vattu')->where('id', $id)->where('id_htx', $htx->id)->count();
        if($check == 0 || ( $vattu->id_htx != $htx->id) ){
            return redirect('htx_vattu');

        }else{
        return view('htx.edit_vattu')->with('loai', $loai)->with('ncc', $ncc)->with('vattu', $vattu);
        }
    }
    public function add_loai_vattu(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $loai = $request->loai;
        $data = array();
        $data['loai'] = $loai;
        $data['id_htx'] = $htx->id;
        $check = DB::table('tbl_loai_vattu')->where('loai', $loai)->where('id_htx', $htx->id)->count();
        if($check == 0){
            DB::table('tbl_loai_vattu')->insert($data);
            Session::put('message', 'Thêm Thành Công');
        }else{
            Session::put('message', 'Đã tồn tại');
        }

        return redirect('htx_loai_vattu');
    }

    public function xoa_vattu($id)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $check = DB::table('tbl_vattu')->where('id',$id)->first();
        if( $check->id_htx != $htx->id ){
            Session::put('message', 'Không thể xóa');
        }else{
            DB::table('tbl_log_vattu')->where('id_vattu', $id)->delete();
            $xvt = DB::table('tbl_xuat_vattu')->where('id_vattu', $id)->get();
            foreach ($xvt as $x) {
                DB::table('tbl_log_xuat_vattu')->where('id_xuat', $x->id)->delete();
            }
            DB::table('tbl_xuat_vattu')->where('id_vattu', $id)->delete();
            DB::table('tbl_vattu')->where('id', $id)->delete();
            Session::put('message', 'Xóa Thành Công');
        }

        return redirect('htx_vattu');
    }

    public function del_loai_vattu($id)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $check = DB::table('tbl_loai_vattu')->where('id',$id)->first();

        if( $check->id_htx != $htx->id  ){
            Session::put('message', 'Không thể xóa');
        }else{
            $d = array();
            $d['loai'] = 0;
            DB::table('tbl_vattu')->where('loai', $id)->update($d);
            DB::table('tbl_loai_vattu')->where('id', $id)->delete();

            Session::put('message', 'Xóa Thành Công');
        }

        return redirect('htx_loai_vattu');
    }

    public function add_ncc_vattu(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
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
        $data['id_htx'] = $htx->id;
        $check = DB::table('tbl_nccvt')->where('MaNCC', $mancc)->where('id_htx', $htx->id)->count();
        if($check == 0){
            DB::table('tbl_nccvt')->insert($data);
            Session::put('message', 'Thêm Thành Công');
        }else{
            Session::put('message', 'Đã tồn tại');
        }
        return redirect('htx_ncc_vattu');
    }

    public function xuat_vat_tu()
    {

        $ncc = DB::table('tbl_nccvt')->get();
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $g_htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->get();
        // return view('htx.ds_member')->with('total', $total);
        $vattu = DB::table('tbl_vattu')->where('id_htx', $htx->id)->get();
        $x_vattu = DB::table('tbl_xuat_vattu')->where('id_htx', $htx->id)->get();
        return view('htx.xuat_vat_tu')->with('ncc', $ncc)->with('htx', $g_htx)->with('vat_tu', $vattu)->with('x_vattu', $x_vattu);

    }
    public function p_xuat_vat_tu(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $vattu =  $request->vat_tu;
        $so_luong = $request->so_luong;
        $nongdan = $request->nongdan;
        if($vattu !='' && $so_luong !='' && $nongdan !=''){
            $check = DB::table('tbl_vattu')->where('id', $vattu)->first();
            if(($check->so_luong-$so_luong) < 0 || $so_luong < 0){
                Session::put('message', 'Số lượng vật tư không đủ');
            }else{

                if(DB::table('tbl_xuat_vattu')->where('id_vattu', $vattu)->where('id_nongdan', $nongdan)->count() > 0){
                    $kt = DB::table('tbl_xuat_vattu')->where('id_vattu', $vattu)->where('id_nongdan', $nongdan)->first();
                    $data = array();
                $data['id_vattu'] =  $vattu;
                $data['id_nongdan'] = $nongdan;
                $data['so_luong'] = $so_luong + $kt->so_luong;

                    DB::table('tbl_xuat_vattu')->where('id_vattu', $vattu)->where('id_nongdan', $nongdan)->update($data);
                    $xuat = $kt->id;
                }else{
                    $data = array();
                $data['id_vattu'] =  $vattu;
                $data['id_nongdan'] = $nongdan;
                $data['so_luong'] = $so_luong;
                $data['thoi_gian'] = time();
                $data['id_htx'] = $htx->id;

                    $xuat = DB::table('tbl_xuat_vattu')->insertGetId($data);

                }

                $d = array();
                $d['id_xuat'] = $xuat;
                $d['so_luong'] = $so_luong;
                $d['time'] =  time();

                DB::table('tbl_log_xuat_vattu')->insert($d);

                $update  = array();
                $update['so_luong'] = $check->so_luong-$so_luong;
                DB::table('tbl_vattu')->where('id', $check->id)->update($update);
                Session::put('message', 'Xuất vật tư thành công');
            }

        }else{
            Session::put('message', 'Vui lòng điền đủ thông tin');
        }

        return redirect('htx_xuat_vattu');

    }

    public function mua_vu()
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $mua_vu = DB::table('tbl_mua_vu')->where('id_htx', $htx->id)->get();
        return view('htx.mua_vu')->with('mua_vu', $mua_vu);

    }

    public function p_mua_vu(Request $request)
    {
        $ten = $request->ten;
        $bat_dau = $request->batdau;
        $ket_thuc = $request->ketthuc;
        if(isset($ten) && isset($bat_dau) && isset($ket_thuc)){
            if(strtotime($bat_dau) < strtotime($ket_thuc)){
                $admin = Session::get('admin');
                $user = DB::table('tbl_users')->where('username', $admin)->first();
                $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
                $check = DB::table('tbl_mua_vu')->where('bat_dau', $bat_dau)->where('ket_thuc', $ket_thuc)->where('id_htx', $htx->id)->count();
                    if($check == 0){

                        $data = array();
                        $data['ten'] = $ten;
                        $data['bat_dau'] = $bat_dau;
                        $data['ket_thuc'] = $ket_thuc;
                        $data['xong'] = 0;
                        $data['id_htx'] = $htx->id;
                        DB::table('tbl_mua_vu')->insert($data);
                        Session::put('message', 'Thêm thành công ');
                    }else{
                        Session::put('message', 'Đã tồn tại');
                    }

            }else{
                Session::put('message', 'Thời gian không hợp lệ');
            }

        }else{
            Session::put('message', 'Vui lòng điền đủ thông tin');
        }
        return redirect('mua_vu');

    }
    public function giong()
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $giong = DB::table('tbl_giong')->where('id_htx', $htx->id)->get();


        return view('htx.giong')->with('giong', $giong);

    }
    public function p_giong(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $ten = $request->ten;
        $nguon_goc = $request->nguon_goc;
        $don_gia = $request->don_gia;
        $so_luong = $request->so_luong;

        $check = DB::table('tbl_giong')->where('ten', $ten)->where('nguon_goc', $nguon_goc)->where('id_htx', $htx->id)->count();
        if(isset($ten) && isset($nguon_goc) && isset($don_gia) && isset($so_luong) ){
            if($check == 0){
                $data = array();
                $data['ten'] = $ten;
                $data['nguon_goc'] = $nguon_goc;
                $data['don_gia'] = $don_gia;
                $data['so_luong'] = $so_luong;
                $data['id_htx'] = $htx->id;
                DB::table('tbl_giong')->insert($data);
                Session::put('message', 'Thêm thành công ');
            }else{
                Session::put('message', 'Đã tồn tại');
            }

        }else{
            Session::put('message', 'Vui lòng điền đủ thông tin');
        }

        return redirect('giong');

    }

    public function thua()
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->get();
        $id_htx = DB::table('tbl_htx')->select('id')->where('chu_nhiem', $user->id)->get();
        $data = array();
        foreach($id_htx as $id){
            array_push($data, $id->id);

        }
        // $data= json_decode( json_encode($data), true);
        // print_r($data);
        // dd($data);
        $thua = DB::table('tbl_thua')->whereIn('id_htx', $data)->get();
        // dd($thua);
        // dd($thua);
        return view('htx.thua')->with('htx', $htx)->with('thua', $thua);

    }
    public function p_thua(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $id_user = $request->id_user;
        $id_htx = $request->id_htx;
        $dien_tich = $request->dien_tich;
        if(isset($id_user) && isset($id_htx) && isset($dien_tich)){

                $data = array();
                $data['id_user'] = $id_user;
                $data['id_htx'] = $id_htx;
                $data['dien_tich'] = $dien_tich;
                DB::table('tbl_thua')->insert($data);
                Session::put('message', 'Thêm thành công ');

        }else{
            Session::put('message', 'Vui lòng điền đủ thông tin');
        }

        return redirect('thua');

    }
    public function xuat_giong()
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $g_htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->get();
        $total = $g_htx->count();
        // return view('htx.ds_member')->with('total', $total);
        $giong = DB::table('tbl_giong')->where('id_htx', $htx->id)->get();
        $x_giong = DB::table('tbl_xuat_giong')->where('id_htx', $htx->id)->get();
        return view('htx.xuat_giong')->with('htx', $g_htx)->with('giong', $giong)->with('x_giong', $x_giong);

    }
    public function p_xuat_giong(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $giong =  $request->giong;
        $so_luong = $request->so_luong;
        $nongdan = $request->nongdan;

        if($giong !='' && $so_luong !='' && $nongdan !=''){
            $check = DB::table('tbl_giong')->where('id', $giong)->first();
            if(($check->so_luong-$so_luong) < 0 || $so_luong < 0){
                Session::put('message', 'Số lượng vật tư không đủ');
            }else{
                if(DB::table('tbl_xuat_giong')->where('id_giong', $giong)->where('id_nongdan', $nongdan)->count() > 0){
                    $kt = DB::table('tbl_xuat_giong')->where('id_giong', $giong)->where('id_nongdan', $nongdan)->first();
                    $data = array();
                $data['id_giong'] =  $giong;
                $data['id_nongdan'] = $nongdan;
                $data['so_luong'] = $so_luong + $kt->so_luong;

                    DB::table('tbl_xuat_giong')->where('id_giong', $giong)->where('id_nongdan', $nongdan)->update($data);
                    $xuat = $kt->id;
                }else{
                    $data = array();
                $data['id_giong'] =  $giong;
                $data['id_nongdan'] = $nongdan;
                $data['so_luong'] = $so_luong;
                $data['thoi_gian'] = time();
                $data['id_htx'] = $htx->id;

                    $xuat = DB::table('tbl_xuat_giong')->insertGetId($data);

                }

                $d = array();
                $d['id_xuat'] = $xuat;
                $d['so_luong'] = $so_luong;
                $d['time'] =  time();

                DB::table('tbl_log_xuat_giong')->insert($d);


                // $data = array();
                // $data['id_giong'] =  $giong;
                // $data['id_nongdan'] = $nongdan;
                // $data['so_luong'] = $so_luong;
                // $data['thoi_gian'] = time();
                // $data['id_htx'] = $htx->id;
                // DB::table('tbl_xuat_giong')->insert($data);
                $update  = array();
                $update['so_luong'] = $check->so_luong-$so_luong;
                DB::table('tbl_giong')->where('id', $check->id)->update($update);
                Session::put('message', 'Xuất vật tư thành công');
            }

        }else{
            Session::put('message', 'Vui lòng điền đủ thông tin');
        }

        return redirect('xuat_giong');

    }
    public function edit_member($id)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $check = DB::table('tbl_users')->where('id', $id)->count();
        $checks = DB::table('tbl_htx_member')->where('id_user', $id)->where('id_htx', $htx->id)->count();
        if($user->role > 2){
            Session::put('message', 'yêu cầu không hợp lệ');
            return redirect('ds_member');
        }else if($checks < 1){
                Session::put('message', 'yêu cầu không hợp lệ');
                return redirect('ds_member');
            }else if($check < 1){
                    Session::put('message', 'yêu cầu không hợp lệ');
                    return redirect('ds_member');
        }else{
        $nd = DB::table('tbl_users')->where('id', $id)->first();
        return view('htx.edit_member')->with('nd', $nd);
        }

    }

    public function x_member($id)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $check = DB::table('tbl_users')->where('id', $id)->count();
        $checks = DB::table('tbl_htx_member')->where('id_user', $id)->where('id_htx', $htx->id)->count();
        if($user->role > 2){
            Session::put('message', 'yêu cầu không hợp lệ');
            return redirect('ds_member');
        }else if($checks < 1){
                Session::put('message', 'yêu cầu không hợp lệ');
                return redirect('ds_member');
            }else if($check < 1){
                    Session::put('message', 'yêu cầu không hợp lệ');
                    return redirect('ds_member');
        }else{
            DB::table('tbl_htx_member')->where('id_user', $id)->delete();
            Session::put('message', 'Xoá thành công');
            return redirect('ds_member');
        }
    }

    public function p_edit_member(Request $request)
    {
        $name = $request->ten;
        $user = $request->user;
        $pass = $request->pass;
        $email = $request->email;
        $sdt = $request->phone;
        $id = $request->id;
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $users->id)->first();
        $check = DB::table('tbl_users')->where('id', $id)->count();
        $checks = DB::table('tbl_htx_member')->where('id_user', $id)->where('id_htx', $htx->id)->count();

        if($users->role == 2){
            if($checks > 0){
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
        Session::put('message', 'Không hợp lệ');
    }
    }else{
        Session::put('message', 'Bạn không có quyền chỉnh sửa');
    }
        return redirect('ds_member');
    }
    public function edit_ncc_vattu($id)
    {

        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $ncc = DB::table('tbl_nccvt')->where('id_htx', $htx->id)->first();
        $check = DB::table('tbl_nccvt')->where('id', $id)->where('id_htx', $htx->id)->count();
        if($check == 0 || ( $ncc->id_htx != $htx->id) ){
            return redirect('htx_ncc_vattu');
        }else{
        return view('htx.edit_nccvt')->with('ncc', $ncc);
        }
    }

    public function p_edit_ncc_vattu(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
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
        $data['id_htx'] = $htx->id;

            DB::table('tbl_nccvt')->where('id', $request->id)->update($data);
            Session::put('message', 'Cập Nhật Thành Công');

        return redirect('htx_ncc_vattu');
    }
    public function x_htx_ncc_vattu($id)
    {

        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $check = DB::table('tbl_nccvt')->where('id', $id)->count();
        $vt = DB::table('tbl_vattu')->where('id_ncc', $id)->get();
        if($check > 0){
            foreach ($vt as $v) {
                $d = array();
                $d['id_ncc'] = '0';
                DB::table('tbl_vattu')->where('id_ncc', $v->id)->update($d);
            }
            DB::table('tbl_nccvt')->where('id', $id)->delete();
            Session::put('message', 'Xóa thành công');
        }

        return redirect('htx_ncc_vattu');
    }
    public function edit_giong($id)
    {
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $users->id)->first();
        $checks = DB::table('tbl_giong')->where('id', $id)->where('id_htx', $htx->id)->count();
        if($checks > 0){
            $giong = DB::table('tbl_giong')->where('id', $id)->first();
            return view('htx.edit_giong')->with('giong', $giong);
        }else{
            Session::put('message', 'Yêu cầu không hợp lệ');
            return redirect('giong');
        }

    }

    public function p_edit_giong(Request $request)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $ten = $request->ten;
        $nguon_goc = $request->nguon_goc;
        $don_gia = $request->don_gia;
        $so_luong = $request->so_luong;

        $check = DB::table('tbl_giong')->where('id', $request->id)->where('id_htx', $htx->id)->count();
        if(isset($ten) && isset($nguon_goc) && isset($don_gia) && isset($so_luong) ){
            if($check > 0){
                $data = array();
                $data['ten'] = $ten;
                $data['nguon_goc'] = $nguon_goc;
                $data['don_gia'] = $don_gia;
                $data['so_luong'] = $so_luong;
                DB::table('tbl_giong')->where('id', $request->id)->update($data);
                Session::put('message', 'cập nhật thành công ');
            }else{
                Session::put('message', 'Không tồn tại');
            }

        }else{
            Session::put('message', 'Vui lòng điền đủ thông tin');
        }

        return redirect('giong');
    }
    public function x_giong($id)
    {
        $admin = Session::get('admin');
        $user = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $user->id)->first();
        $check = DB::table('tbl_giong')->where('id',$id)->first();
        if( $check->id_htx != $htx->id ){
            Session::put('message', 'Không thể xóa');
        }else{
            DB::table('tbl_log_giong')->where('id_giong', $id)->delete();
            $xvt = DB::table('tbl_xuat_giong')->where('id_giong', $id)->get();
            foreach ($xvt as $x) {
                DB::table('tbl_log_xuat_giong')->where('id_xuat', $x->id)->delete();
            }
            DB::table('tbl_xuat_giong')->where('id_giong', $id)->delete();
            DB::table('tbl_giong')->where('id', $id)->delete();
            Session::put('message', 'Xóa Thành Công');
        }
        return redirect('giong');
    }
    public function cn_info()
    {
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        return view('htx.info')->with('u', $users);


    }
    public function cn_htx()
    {
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $users->id)->first();
        return view('htx.edit_htx')->with('htx', $htx);


    }
    public function p_cn_htx(Request $request)
    {
        $ten = $request->ten;
        $mst = $request->mst;
        $diachi = $request->diachi;
        $sdt = $request->phone;
        $admin = Session::get('admin');
        $users = DB::table('tbl_users')->where('username', $admin)->first();
        $htx = DB::table('tbl_htx')->where('chu_nhiem', $users->id)->first();
        if($ten != '' && $mst != ''){
            $data = array();
            $data['ten'] = $ten;
            $data['ma_so_thue'] = $mst;
            if($diachi){
                $data['dia_chi'] = $diachi;
            }
            if($sdt){
                $data['so_dien_thoai'] = $sdt;
            }
                DB::table('tbl_htx')->where('id', $htx->id)->update($data);
                Session::put('message', 'Thông tin được cập nhật thành công');

        }else{
            Session::put('message', 'Vui lòng điền đầy đủ thông tin');
        }
        return redirect('cn_htx');

    }


}
