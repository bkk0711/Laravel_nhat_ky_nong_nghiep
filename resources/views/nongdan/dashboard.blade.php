@extends('nongdan_layout')
@section('title', 'Dashboard')
@section('nongdan_content')
<div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card border-info">
            <div class="media">
                <div class="p-20 text-center bg-info media-left media-middle icon-section-left">
                    <i class="ti-package fa-3x text-white"></i>
                </div>
                <div class="p-20 media-body">
                    <h5>Tổng số loại giống</h5>
                    <h3>{{DB::table('tbl_xuat_giong')->where('id_nongdan', $user)->count()}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card border-danger">
            <div class="media">
                <div class="p-20 text-center badge-danger media-left media-middle icon-section-left">
                    <i class="fa fa-cubes fa-3x text-white"></i>
                </div>
                <div class="p-20 media-body">
                    <h5>Tổng số loại vật tư</h5>
                    <h3>{{DB::table('tbl_xuat_vattu')->where('id_nongdan', $user)->count()}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
      <div class="card border-success">
            <div class="media">
                <div class="p-20 text-center bg-success media-left media-middle icon-section-left">
                    <i class="fa fa-shopping-basket fa-3x text-white"></i>
                </div>
                <div class="p-20 media-body">
                    <h5>Tổng số giống </h5>
                    <h3>{{number_format(DB::table('tbl_xuat_giong')->where('id_nongdan', $user)->sum('so_luong'))}} Kg</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card border-warning">
            <div class="media">
                <div class="p-20 text-center bg-warning media-left media-middle icon-section-left">
                    <i class="fa fa-shopping-cart fa-3x text-white"></i>
                </div>
                <div class="p-20 media-body">
                    <h5>Tổng số vật tư </h5>
                    <h3>{{number_format(DB::table('tbl_xuat_vattu')->where('id_nongdan', $user)->sum('so_luong'))}} </h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-30">
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="card p-20">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="fa fa-credit-card fa-3x text-info"></i>
                </div>
                <?php
                $sql = DB::table('tbl_xuat_giong')->where('id_nongdan', $user)->get();
                $tong = 0;
                foreach ($sql as $t) {
                    $g = DB::table('tbl_giong')->where('id', $t->id_giong)->first();
                    $tong += $t->so_luong * $g->don_gia;
                }
                ?>
                <div class="media-body text-right">
                    <h3>{{number_format($tong)}} VNĐ</h3>
                    <span><b>Tổng tiền mua giống</b></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="card p-20">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="fa fa-credit-card fa-3x text-danger"></i>
                </div>
                <?php
                $sql = DB::table('tbl_xuat_vattu')->where('id_nongdan', $user)->get();
                $tong = 0;
                foreach ($sql as $t) {
                    $g = DB::table('tbl_vattu')->where('id', $t->id_vattu)->first();
                    $tong += $t->so_luong * $g->don_gia;
                }
                ?>
                <div class="media-body text-right">
                    <h3>{{number_format($tong)}} VNĐ</h3>
                    <span><b>Tổng tiền mua vật tư</b></span>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="row mt-30">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-10 full-bor-info">
            <div class="card-icons">
                <span class="bg-info border-top-left-radius"></span> <i class="icon-basket-loaded"></i>
            </div>
            <div>
                <h4 class="text-right mt-5">Số giống đã dùng</h4>
                <h2 class="mt-15 text-right">{{number_format(DB::table('tbl_log_giong')->where('id_user', $user)->sum('so_luong'))}} Kg</h2>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-10 full-bor-danger">
            <div class="card-icons">
                <span class="bg-danger border-top-left-radius"></span> <i class="icon-pie-chart"></i>
            </div>
            <div>
                <h4 class="text-right mt-5">Số giống còn tồn</h4>
                <h2 class="mt-15 text-right">{{number_format((DB::table('tbl_xuat_giong')->where('id_nongdan', $user)->sum('so_luong'))-(DB::table('tbl_log_giong')->where('id_user', $user)->sum('so_luong')))}} Kg</h2>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-10 full-bor-success">
            <div class="card-icons">
                <span class="bg-success border-top-left-radius"></span> <i class="icon-layers"></i>
            </div>
            <div>
                <h4 class="text-right mt-5">Vật tư đã dùng</h4>
                <h2 class="mt-15 text-right">{{number_format(DB::table('tbl_log_vattu')->where('id_user', $user)->sum('so_luong'))}}</h2>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-10 full-bor-warning">
            <div class="card-icons">
                <span class="bg-warning border-top-left-radius"></span> <i class="icon-credit-card"></i>
            </div>
            <div>
                <h4 class="text-right mt-5">Vật tư còn tồn</h4>
                <h2 class="mt-15 text-right">{{number_format((DB::table('tbl_xuat_vattu')->where('id_nongdan', $user)->sum('so_luong'))-(DB::table('tbl_log_vattu')->where('id_user', $user)->sum('so_luong')))}}</h2>

            </div>
        </div>
    </div>
</div>


<div class="row mt-30">
    <div class="col-lg-12">
        <div class="panel panel-outline panel-black">
            <div class="panel-heading">
                <h3 class="panel-title">Nhật ký làm đất</h3>
            </div>
            <div class="panel-body">
                <?php
                $sql = DB::table('tbl_log_lamdat')->where('id_user', $user)->offset(0)->limit(10)->get();
                ?>
                @foreach ($sql as $s)
                <?php
                $t = DB::table('tbl_thua')->where('id', $s->id_thua)->first();
                if($t){
                    $ten =$t->ten;
                }else{
                    $ten = "...";
                }
                ?>
                <div class="alert alert-border-default alert-dismissible fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                   Ngày <strong>{{date('d-m-Y',strtotime($s->ngay))}} </strong>bạn vừa làm đất ở <strong>{{$ten}}</strong> với ghi chú : <i>"{{$s->note}} "</i>
                </div>
                @endforeach

             </div>
        </div>
    </div>
</div>

<div class="row mt-30">
    <div class="col-lg-6">
       <div class="panel panel-outline panel-danger">
           <div class="panel-heading">
               <h3 class="panel-title">Các lần nhận vật tư gần nhất</h3>
           </div>
        <div class="panel-body">
            <?php
            $sql = DB::table('tbl_xuat_vattu')->where('id_nongdan', $user)->offset(0)->limit(3)->get();
            ?>
            @foreach ($sql as $s)
            <?php
            $db = DB::table('tbl_log_xuat_vattu')->where('id_xuat', $s->id)->offset(0)->limit(3)->get();
            ?>
            @foreach ($db as $l)
            <?php
            $vt = DB::table('tbl_vattu')->where('id', $s->id_vattu)->first();
            $lt = DB::table('tbl_loai_vattu')->where('id', $vt->loai)->first();
            $u = DB::table('tbl_htx')->where('id', $vt->id_htx)->first();
            ?>
            <div class="alert alert-border-default alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               Bạn đã nhận  <i>"{{$l->so_luong}}" vật tư</i>{{$lt->loai}} có tên là <strong>{{$vt->ten}}</strong> từ <strong>{{$u->ten}}</strong> vào ngày <strong>{{date('d-m-Y',$l->time)}} </strong>

            </div>
            @endforeach
            @endforeach

        </div>
       </div>
   </div>
   <div class="col-lg-6">
       <div class="panel panel-outline panel-info">
           <div class="panel-heading">
               <h3 class="panel-title">Các lần nhận giống gần nhất</h3>
           </div>
           <div class="panel-body">
            <?php
            $sql = DB::table('tbl_xuat_giong')->where('id_nongdan', $user)->offset(0)->limit(3)->get();
            ?>
            @foreach ($sql as $s)
            <?php
            $db = DB::table('tbl_log_xuat_giong')->where('id_xuat', $s->id)->offset(0)->limit(3)->get();
            ?>
            @foreach ($db as $l)
            <?php
            $vt = DB::table('tbl_giong')->where('id', $s->id_giong)->first();
            $u = DB::table('tbl_htx')->where('id', $vt->id_htx)->first();

            ?>
            <div class="alert alert-border-default alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               Bạn đã nhận  <i>"{{$l->so_luong}}" Kg</i>giống lúa <strong>{{$vt->ten}}</strong> từ <strong>{{$u->ten}}</strong> vào ngày <strong>{{date('d-m-Y',$l->time)}} </strong>

            </div>
            @endforeach
            @endforeach
        </div>
       </div>
   </div>
</div>

<div class="row mt-30">
    <div class="col-lg-6">
       <div class="panel panel-outline panel-warning">
           <div class="panel-heading">
               <h3 class="panel-title">Các lần dùng vật tư gần nhất</h3>
           </div>
           <div class="panel-body">
            <?php
            $sql = DB::table('tbl_log_vattu')->where('id_user', $user)->offset(0)->limit(10)->get();
            ?>
            @foreach ($sql as $s)
            <?php
            $vt = DB::table('tbl_vattu')->where('id', $s->id_vattu)->first();
            $l = DB::table('tbl_loai_vattu')->where('id', $vt->loai)->first();
            ?>
            <div class="alert alert-border-default alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               Bạn đã dùng  <i>"{{$s->so_luong}}" vật tư</i>{{$l->loai}} có tên là <strong>{{$vt->ten}}</strong> vào ngày <strong>{{date('d-m-Y',strtotime($s->ngay))}} </strong>

            </div>
            @endforeach
        </div>
       </div>
   </div>
   <div class="col-lg-6">
       <div class="panel panel-outline panel-success">
           <div class="panel-heading">
               <h3 class="panel-title">Các lần dùng xuống giống gần nhất</h3>
           </div>
           <div class="panel-body">
            <?php
            $sql = DB::table('tbl_log_giong')->where('id_user', $user)->offset(0)->limit(10)->get();
            ?>
            @foreach ($sql as $s)
            <?php
            $vt = DB::table('tbl_giong')->where('id', $s->id_giong)->first();

                $t = DB::table('tbl_thua')->where('id', $s->id_thua)->first();
                if($t){
                    $ten =$t->ten;
                }else{
                    $ten = "...";
                }
                ?>

            <div class="alert alert-border-default alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               Bạn đã dùng  <i>"{{$s->so_luong}}" Kg</i>giống lúa<strong> {{$vt->ten}} </strong> ở <strong>{{$ten}}</strong> vào ngày <strong>{{date('d-m-Y',strtotime($s->ngay))}} </strong>

            </div>
            @endforeach  </div>
       </div>
   </div>
</div>

@endsection
