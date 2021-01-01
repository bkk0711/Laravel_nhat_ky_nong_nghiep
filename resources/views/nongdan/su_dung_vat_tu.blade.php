@extends('nongdan_layout')
@section('title', 'Nhật ký sử dụng vật tư')
@section('nongdan_content')
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
      <h3 class="panel-title">Sử dụng vật tư</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" action="{{URL::to('su_dung_vat_tu')}}" method="POST">
        @csrf

        <div class="form-group">
            <label class="col-sm-3 control-label">Chọn vật tư</label>
            <div class="col-sm-9">
             <select name="vattu" id="" class="form-control">
                 @foreach ($vattus as $vt)
                <?php
                $vts = DB::table('tbl_vattu')->where('id', $vt->id_vattu)->first();
                ?>
                 <option value="{{$vts->id}}"> {{$vts->ten}}</option>

                 @endforeach
             </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Ngày sử dụng</label>
            <div class="col-sm-9">
              <input type="text" name="ngay" class="form-control" id="mydate">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Số lượng</label>
            <div class="col-sm-9">
              <input type="number" name="so_luong" class="form-control" >
            </div>
        </div>

        <div class="form-footer">

              <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Lưu</button>
          </div>

      </form>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Vật tư đang có</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
       <table id="data0" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vật tư</th>
                <th>Số lượng</th>
                <th>Đã dùng</th>
                <th>Tồn</th>

            </tr>
        </thead>

        <tbody>
            <?php $i=0?>
            @foreach ($vattus as $vt)
            <?php
             $vts = DB::table('tbl_vattu')->where('id', $vt->id_vattu)->first();
             if(DB::table('tbl_log_vattu')->where('id_vattu', $vt->id_vattu)->where('id_user', $id_u)->count() > 0){
                $total = DB::table('tbl_log_vattu')->where('id_vattu', $vt->id_vattu)->where('id_user', $id_u)->sum('so_luong');
                $da_dung = $total;
             }else{
                $da_dung = 0;
             }

            ?>
            <tr>
            <td>{{$i+=1}}</td>
            <td>{{$vts->ten}}</td>
            <td>{{number_format($vt->so_luong)}}</td>
            <td>{{number_format($da_dung)}}</td>
            <td>{{number_format($vt->so_luong-$da_dung)}}</td>
        </tr>
            @endforeach


        </tbody>
    </table>
    </div>
</div>
</div>
</div>

  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Nhật ký sử dụng vật tư </h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
       <table id="data-buttons" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ngày sử dụng</th>
                <th>Vật tư</th>
                <th>Số lượng</th>

            </tr>
        </thead>

        <tbody>
            <tr>
            <?php $i=0?>
            @foreach ($vattu as $vt)
            <?php
             $vts = DB::table('tbl_vattu')->where('id', $vt->id_vattu)->first();
            ?>
            <td>{{$i+=1}}</td>
            <td>{{date('d-m-Y', strtotime($vt->ngay))}}</td>
            <td>{{$vts->ten}}</td>
            <td>{{number_format($vt->so_luong)}}</td>
        </tr>
            @endforeach


        </tbody>
    </table>
    </div>
</div>
</div>
</div>

@endsection
