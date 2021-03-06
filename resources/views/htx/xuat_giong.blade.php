@extends('htx_layout')
@section('title', 'Xuất lúa giống')
@section('HTX_content')
<div class="row">
    <div class="col-md-12">
        <?php
        $message =  Session::get('message');
        if(isset($message)){
          echo'<div class="alert alert-success alert-dismissible fade in">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              '.$message.'
                                </div>';
        Session::put('message', null);

        }
        ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"> Xuất lúa giống</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal form-bordered striped-rows" method="POST" action="{{ URL::to('xuat_giong') }}">

           <div class="form-group">
               <label class="col-sm-3 control-label">Giống lúa <font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                   <select name="giong" id="" class="form-control" >
                       @foreach ($giong as $g)
                       <option value="{{$g->id}}"> {{$g->ten}} </option>
                       @endforeach

                   </select>

               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Số lượng <font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                 <input type="number" class="form-control"  name="so_luong" min="1">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Nông dân<font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">

                <select name="nongdan" id="" class="form-control" >
                    @foreach ($htx as $h)
                    <?php
                    $user_htx = DB::table('tbl_htx_member')->where('id_htx', $h->id)->distinct('id_user')->get();
                    ?>
                     @foreach ($user_htx as $u)
                    <?php
                    $u_htx = DB::table('tbl_users')->where('id', $u->id_user)->first();
                    ?>
                    <option value="{{$u_htx->id}}"> {{$u_htx->name}}</option>
                    @endforeach
                    @endforeach
                </select>
               </div>
           </div>

           {{ csrf_field() }}
           <div class="form-footer">
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Xuất Vật Tư</button>
             </div>

         </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Nhật ký xuất lúa giống</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên vật tư</th>
                        <th>Tên người nhận</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Thời gian</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 0;
                    ?>
                    @foreach ($x_giong as $xvt)
                    <?php

                    $vattu = DB::table('tbl_giong')->where('id', $xvt->id_giong)->first();
                    $u = DB::table('tbl_users')->where('id', $xvt->id_nongdan)->first();
                    $log = DB::table('tbl_log_xuat_giong')->where('id_xuat', $xvt->id)->get();
                    ?>
                    @foreach ($log as $l)


                    <tr>

                        <td>{{ $i += 1 }}</td>
                        <td>{{ $vattu->ten }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ number_format($l->so_luong) }}</td>
                        <td>{{ number_format($vattu->don_gia*$l->so_luong) }} VNĐ</td>
                        <td>{{ date('d-m-Y', $l->time) }}</td>




                    </tr>
                    @endforeach
                    @endforeach


                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
  </div>
@endsection
