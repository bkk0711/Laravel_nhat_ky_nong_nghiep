@extends('nongdan_layout')
@section('title', 'Nhật ký nhận vật tư')
@section('nongdan_content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Nhật ký nhận vật tư </h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
       <table id="data-buttons" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nhật ký</th>
                <th>Số lượng</th>
                <th> Giá tiền</th>
                <th>Thành tiền</th>


            </tr>
        </thead>

        <tbody>
            <?php $i=0?>
            @foreach ($vattu as $vt)
            <?php
           $u = DB::table('tbl_htx')->where('id', $vt->id_htx)->first();
            $vts = DB::table('tbl_vattu')->where('id', $vt->id_vattu)->first();
            $log = DB::table('tbl_log_xuat_vattu')->where('id_xuat', $vt->id)->get();

            ?>
            @foreach ($log as $l)
            <tr>
                <td>{{$i +=1}}</td>
                <td><b>{{$u->ten}}</b> đã xuất <b>{{$vts->ten}}</b> cho bạn vào ngày <b>{{date('d-m-Y', $l->time)}}</b></td>
                <td>{{number_format($l->so_luong)}}</td>
                <td>{{number_format($vts->don_gia)}} VNĐ</td>
                <td>{{number_format($l->so_luong*$vts->don_gia)}} VNĐ</td>


            </tr>
            @endforeach
            @endforeach


        </tbody>
    </table>
    </div>
</div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Nhật ký nhận lúa giống</a> </h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
       <table id="data0" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nhật ký</th>
                <th>Số lượng</th>
                <th> Giá tiền</th>
                <th>Thành tiền</th>


            </tr>
        </thead>

        <tbody>
            <?php $i=0?>
            @foreach ($giong as $vt)
            <?php
            $u = DB::table('tbl_htx')->where('id', $vt->id_htx)->first();
            $g = DB::table('tbl_giong')->where('id', $vt->id_giong)->first();
            $log = DB::table('tbl_log_xuat_giong')->where('id_xuat', $vt->id)->get();
            ?>
            @foreach ($log as $l)


            <tr>
                <td>{{$i +=1}}</td>
                <td><b>{{$u->ten}}</b> đã xuất <b>{{$g->ten}}</b> cho bạn vào ngày <b>{{date('d-m-Y', $l->time)}}</b></td>
                <td>{{number_format($l->so_luong)}}</td>
                <td>{{number_format($g->don_gia)}} VNĐ</td>
                <td>{{number_format($l->so_luong*$g->don_gia)}} VNĐ</td>


            </tr>
            @endforeach
            @endforeach


        </tbody>
    </table>
    </div>
</div>
</div>
</div>

@endsection
