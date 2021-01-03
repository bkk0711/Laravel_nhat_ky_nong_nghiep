@extends('nongdan_layout')
@section('title', 'Nhật ký xuống giống')
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
      <h3 class="panel-title">Nhật ký xuống giống</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" action="{{URL::to('xuong_giong')}}" method="POST">
        @csrf
        <div class="form-group">
            <label class="col-sm-3 control-label">Ngày xuống giống</label>
            <div class="col-sm-9">
              <input type="text" name="ngay" class="form-control" id="mydate">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Giống lúa </label>
            <div class="col-sm-9">
            <select name="giong" id="" class="form-control">
                @foreach ($giongs as $g)
                <?php
                $gl = DB::table('tbl_giong')->where('id', $g->id_giong)->first();
                ?>
                    <option value="{{$gl->id}}">{{$gl->ten}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Số lượng</label>
            <div class="col-sm-9">
            <input type="number" name="so_luong" id="" min="1" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Thửa</label>
            <div class="col-sm-9">
              <select name="thua" id="" class="form-control">
                  @foreach ($thua as $t)
                   <option value="{{$t->id}}">{{$t->ten}}</option>
                  @endforeach
              </select>
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
        <h3 class="panel-title">Lúa giống đang có</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
       <table id="data0" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Giống lúa</th>
                <th>Số lượng</th>
                <th>Đã dùng</th>
                <th>Tồn</th>

            </tr>
        </thead>

        <tbody>
            <?php $i=0?>
            @foreach ($giongs as $g)
            <?php
             $gs = DB::table('tbl_giong')->where('id', $g->id_giong)->first();
             if(DB::table('tbl_log_giong')->where('id_giong', $g->id_giong)->where('id_user', $id_u)->count() > 0){
                $total = DB::table('tbl_log_giong')->where('id_giong', $g->id_giong)->where('id_user', $id_u)->sum('so_luong');
                $da_dung = $total;
             }else{
                $da_dung = 0;
             }

            ?>
            <tr>
            <td>{{$i+=1}}</td>
            <td>{{$gs->ten}}</td>
            <td>{{number_format($g->so_luong)}}</td>
            <td>{{number_format($da_dung)}}</td>
            <td>{{number_format($g->so_luong-$da_dung)}}</td>
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
        <h3 class="panel-title">Nhật ký xuống giống </h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
       <table id="data-buttons" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ngày sử dụng</th>
                <th>Giống lúa</th>
                <th>Số lượng</th>
                <th>Thửa</th>

            </tr>
        </thead>

        <tbody>
            <tr>
            <?php $i=0?>
            @foreach ($giong as $g)
            <?php
             $gs = DB::table('tbl_giong')->where('id', $g->id_giong)->first();
             $t = DB::table('tbl_thua')->where('id', $g->id_thua)->first();
            ?>
            <td>{{$i+=1}}</td>
            <td>{{date('d-m-Y', strtotime($g->ngay))}}</td>
            <td>{{$gs->ten}}</td>
            <td>{{number_format($g->so_luong)}}</td>
            @if ($t)
            <td>{{$t->ten}}</td>
            @else
                <td>Không xác định</td>
            @endif
        </tr>
            @endforeach


        </tbody>
    </table>
    </div>
</div>
</div>
</div>

@endsection
