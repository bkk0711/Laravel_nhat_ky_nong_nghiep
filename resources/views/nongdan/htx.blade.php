@extends('nongdan_layout')
@section('title', 'Hợp tác xã')
@section('nongdan_content')
<div class="row">


    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Danh Sách Hợp Tác Xã của bạn </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Mã Số Thuế</th>
                        <th>Chủ nhiệm</th>
                        <th>Địa Chỉ</th>
                        <th>Số điện thoại</th>

                    </tr>
                </thead>

                <tbody>
                    <?php $i=0;?>
                @foreach ($htx as $h)
                <?php
                $g_htx = DB::table('tbl_htx')->where('id', $h->id_htx)->first();
                ?>
                <tr>
                    <td>{{$i+=1}}</td>
                    <td>{{ $g_htx->ten}}</td>
                    <td>{{ $g_htx->ma_so_thue}}</td>
                    @if (DB::table('tbl_users')->where('id', $g_htx->chu_nhiem)->first()->name)
                    <td>{{DB::table('tbl_users')->where('id', $g_htx->chu_nhiem)->first()->name}}</td>
                    @else
                        <td>Chưa có chủ nhiệm</td>
                    @endif
                    <td>{{$g_htx->dia_chi}}</td>
                    <td>{{ $g_htx->so_dien_thoai}}</td>

                </tr>
                @endforeach


                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
  </div>
@endsection
