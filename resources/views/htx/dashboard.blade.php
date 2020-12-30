@extends('htx_layout')
@section('title', 'Dashboard')
@section('HTX_content')

<div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card border-info">
            <div class="media">
                <div class="p-20 text-center bg-info media-left media-middle icon-section-left">
                    <i class="ti-package fa-3x text-white"></i>
                </div>
                <div class="p-20 media-body">
                    <h5>Tổng số loại giống</h5>
                    <h3>{{DB::table('tbl_giong')->where('id_htx', $htx)->count()}}</h3>
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
                    <h3>{{DB::table('tbl_vattu')->where('id_htx', $htx)->count()}}</h3>
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
                    <h5>Tồn kho giống </h5>
                    <h3>{{number_format(DB::table('tbl_giong')->where('id_htx', $htx)->sum('so_luong'))}} Kg</h3>
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
                    <h5>Tồn kho vật tư </h5>
                    <h3>{{number_format(DB::table('tbl_vattu')->where('id_htx', $htx)->sum('so_luong'))}} </h3>
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
                $sql = DB::table('tbl_xuat_giong')->where('id_htx', $htx)->get();
                $tong = 0;
                foreach ($sql as $t) {
                    $g = DB::table('tbl_giong')->where('id', $t->id_giong)->first();
                    $tong += $t->so_luong * $g->don_gia;
                }
                ?>
                <div class="media-body text-right">
                    <h3>{{number_format($tong)}} VNĐ</h3>
                    <span><b> DOANH THU BÁN LÚA GIỐNG</b></span>
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
                $sql = DB::table('tbl_xuat_vattu')->where('id_htx', $htx)->get();
                $tong = 0;
                foreach ($sql as $t) {
                    $g = DB::table('tbl_vattu')->where('id', $t->id_vattu)->first();
                    $tong += $t->so_luong * $g->don_gia;
                }
                ?>
                <div class="media-body text-right">
                    <h3>{{number_format($tong)}} VNĐ</h3>
                    <span><b>DOANH THU BÁN VẬT TƯ</b></span>
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
                <h4 class="text-right mt-5">Số giống đã bán</h4>
                <h2 class="mt-15 text-right">{{number_format(DB::table('tbl_xuat_giong')->where('id_htx', $htx)->sum('so_luong'))}} Kg</h2>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-10 full-bor-danger">
            <div class="card-icons">
                <span class="bg-danger border-top-left-radius"></span> <i class="icon-pie-chart"></i>
            </div>
            <div>
                <h4 class="text-right mt-5">Vật tư đã bán</h4>
                <h2 class="mt-15 text-right">{{number_format(DB::table('tbl_xuat_vattu')->where('id_htx', $htx)->sum('so_luong'))}}</h2>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-10 full-bor-success">
            <div class="card-icons">
                <span class="bg-success border-top-left-radius"></span> <i class="fa fa-users fa-2x text-white"></i>
            </div>
            <div>
                <h4 class="text-right mt-5">Số thành viên HTX</h4>
                <h2 class="mt-15 text-right">{{number_format(DB::table('tbl_htx_member')->where('id_htx', $htx)->count())}}</h2>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-10 full-bor-warning">
            <div class="card-icons">
                <span class="bg-warning border-top-left-radius"></span> <i class="icon-credit-card"></i>
            </div>
            <div>
                <h4 class="text-right mt-5">Số NCC vật tư</h4>
                <h2 class="mt-15 text-right">{{number_format(DB::table('tbl_nccvt')->where('id_htx', $htx)->count())}}</h2>

            </div>
        </div>
    </div>
</div>



<div class="row mt-30">

    <div class="col-lg-12">
        <?php

        $us = DB::table('tbl_mua_vu')->where('bat_dau', '<=', date('Y-m-d', time()))->where('ket_thuc', '>=', date('Y-m-d', time()))->where('id_htx', $htx)->orderBy('id', 'DESC')->first();
        ?>
        @if ($us)


        <div class="alert alert-border-primary alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

            <i class="fa fa-user"></i> <strong>{{$us->ten}}</strong> là vụ mùa đang diễn ra

        </div>
        @endif
        <?php
        $us = DB::table('tbl_htx_member')->where('id_htx', $htx)->orderBy('id', 'DESC')->first();

        ?>
         @if ($us)
        <div class="alert alert-border-default alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?php
            $u = DB::table('tbl_users')->where('id', $us->id_user)->first();
            ?>
            <i class="fa fa-user"></i> <strong>{{$u->name}}</strong> là thành viên mới nhất của hợp tác xã

        </div>
        @endif
        <?php
        $us = DB::table('tbl_nccvt')->where('id_htx', $htx)->orderBy('id', 'DESC')->first();

        ?>
         @if ($us)
        <div class="alert alert-border-danger alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

            <i class="fa fa-user"></i> <strong>{{$us->TenNCC}}</strong> là nhà cung cấp vật tư mới nhất của hợp tác xã

        </div>
        @endif
        <?php
        $us = DB::table('tbl_vattu')->where('id_htx', $htx)->orderBy('id', 'DESC')->first();

        ?>
        @if ($us)
        <div class="alert alert-border-warning alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

            <i class="fa fa-user"></i> <strong>{{$us->ten}}</strong> là vật tư mới nhất của hợp tác xã

        </div>
        @endif
        <?php
            $us = DB::table('tbl_giong')->where('id_htx', $htx)->orderBy('id', 'DESC')->first();

            ?>
 @if ($us)
        <div class="alert alert-border-success alert-dismissible fade in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>

            <i class="fa fa-user"></i> <strong>{{$us->ten}}</strong> là giống lúa mới nhất của hợp tác xã

        </div>
        @endif

    </div>
</div>

@endsection
