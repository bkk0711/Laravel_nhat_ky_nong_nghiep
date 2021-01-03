@extends('nongdan_layout')
@section('title', 'Nhật ký làm đất')
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
      <h3 class="panel-title">Nhật ký làm đất</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" action="{{URL::to('lam_dat')}}" method="POST">
        @csrf
        <div class="form-group">
            <label class="col-sm-3 control-label">Ngày làm đất</label>
            <div class="col-sm-9">
              <input type="text" name="ngay" class="form-control" id="mydate">
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

        <div class="form-group">
            <label class="col-sm-3 control-label">Note</label>
            <div class="col-sm-9">
             <textarea name="note" id="" cols="30" rows="2" class="form-control"></textarea>
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
        <h3 class="panel-title">Nhật ký làm đất </h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
       <table id="data-buttons" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ngày</th>
                <th>Thửa</th>
                <th>Ghi chú</th>

            </tr>
        </thead>

        <tbody>
            <?php $i=0?>
            @foreach ($lamdat as $ld)
            <?php
            $t = DB::table('tbl_thua')->where('id', $ld->id_thua)->first();
            ?>
            <tr>
                <td>{{$i +=1}}</td>
                <td>{{date('d-m-Y', strtotime($ld->ngay))}}</td>
                @if ($t)
                <td>{{$t->ten}}</td>
                @else
                    <td>Không xác định</td>
                @endif

                <td>{{$ld->note}}</td>

            </tr>
            @endforeach


        </tbody>
    </table>
    </div>
</div>
</div>
</div>

@endsection
