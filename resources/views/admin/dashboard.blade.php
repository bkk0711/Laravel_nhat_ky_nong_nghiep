@extends('admin_layout')
@section('title', 'Dashboard')
@section('admin_content')
<div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="icon-book-open fa-3x text-info"></i>
                </div>
                <div class="media-body text-right">
                    <h3>{{number_format(DB::table('tbl_users')->count())}}</h3>
                    <span>Tổng số người dùng</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="icon-bubbles fa-3x text-danger"></i>
                </div>
                <div class="media-body text-right">
                    <h3>{{number_format(DB::table('tbl_users')->where('role', '2')->count())}}</h3>
                    <span>Tổng số Chủ nhiệm HTX</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="icon-graph fa-3x text-success"></i>
                </div>
                <div class="media-body text-right">
                    <h3>{{number_format(DB::table('tbl_users')->where('role', '3')->count())}}</h3>
                    <span>Tổng sô Nông Dân</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="icon-eye fa-3x text-warning"></i>
                </div>
                <div class="media-body text-right">
                    <h3>{{number_format(DB::table('tbl_htx')->count())}}</h3>
                    <span>Tổng số HTX</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-30">
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="card p-20 bg-info">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="icon-user fa-3x text-white"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="text-white">{{number_format(DB::table('tbl_giong')->sum('so_luong'))}}</h3>
                    <span class="text-white">Tổng sản lượng lúa giống</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="card p-20 bg-danger">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="fa fa-cube fa-3x text-white"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="text-white">{{number_format(DB::table('tbl_vattu')->sum('so_luong'))}}</h3>
                    <span class="text-white">Tổng tồn kho vật tư</span>
                </div>
            </div>
        </div>
    </div> </div>
    <div class="row mt-30">
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="card p-20 bg-success">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="icon-graph fa-3x text-white"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="text-white">{{number_format(DB::table('tbl_xuat_giong')->sum('so_luong'))}}</h3>
                    <span class="text-white">Tổng lượng lúa giống đã bán</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="card p-20 bg-warning">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="ti-bar-chart-alt fa-3x text-white"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="text-white">{{number_format(DB::table('tbl_xuat_vattu')->sum('so_luong'))}}</h3>
                    <span class="text-white">Tổng số lượng vật tư đã bán</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-30">

    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20 Leaf">
            <div class="media">
                <div class="media-body text-left">
                    <h3 class="text-primary">{{number_format(DB::table('tbl_nccvt')->count())}}</h3>
                    <span>Tổng số NCC vật tư</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-pencil fa-3x text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20 Leaf">
            <div class="media">
                <div class="media-body text-left">
                    <h3 class="text-black">{{number_format(DB::table('tbl_loai_vattu')->count())}}</h3>
                    <span>Tổng số loại vật tư</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-speech fa-3x text-black"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20 Leaf">
            <div class="media">
                <div class="media-body text-left">
                    <h3 class="text-blue">{{number_format(DB::table('tbl_vattu')->count())}}</h3>
                    <span>Tổng số vật tư</span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-pie-chart fa-3x text-blue"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20 Leaf">
            <div class="media">
                <div class="media-body text-left">
                    <h3 class="text-rose">{{number_format(DB::table('tbl_giong')->count())}}</h3>
                    <span>Tổng số giống </span>
                </div>
                <div class="media-right media-middle">
                    <i class="icon-pie-chart fa-3x text-rose"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row mt-30">
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="card bg-primary">
            <div class="media">
                <div class="p-20 text-center media-left media-middle icon-section-primary icon-section-left">
                    <i class="ti-package fa-3x text-white"></i>
                </div>
                <?php
                $sql = DB::table('tbl_xuat_vattu')->get();
                $tong = 0;
                foreach ($sql as $t) {
                    $g = DB::table('tbl_vattu')->where('id', $t->id_vattu)->first();
                    $tong += $t->so_luong * $g->don_gia;
                }
                ?>
                <div class="p-20 media-body">
                    <h4 class="text-white">Tổng doanh thu vật tư</h4>
                    <h4 class="text-white">{{number_format($tong)}} VNĐ</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="card bg-rose">
            <div class="media">
                <div class="p-20 text-center media-left media-middle icon-section-rose icon-section-left">
                    <i class="ti-package fa-3x text-white"></i>
                    <?php
                    $sql = DB::table('tbl_xuat_giong')->get();
                    $tong = 0;
                    foreach ($sql as $t) {
                        $g = DB::table('tbl_giong')->where('id', $t->id_giong)->first();
                        $tong += $t->so_luong * $g->don_gia;
                    }
                    ?>
                </div>
                <div class="p-20 media-body">
                    <h4 class="text-white">Tổng doanh thu giống lúa</h4>
                    <h4 class="text-white">{{number_format($tong)}} VNĐ</h4>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
