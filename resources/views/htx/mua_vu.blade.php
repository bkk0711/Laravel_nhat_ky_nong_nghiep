@extends('htx_layout')
@section('title', 'Quản lý mùa vụ')
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
          <h3 class="panel-title">Thêm vụ mùa</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('mua_vu')}}" method="POST">

            @csrf

            <div class="form-group">
                <label class="col-sm-3 control-label">Tên vụ mùa</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="ten">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Thời gian</label>
                <div class="col-sm-9">
                <div class="row">
                    <div class="col-md-6">
                        <label>Bắt đầu</label>
                        <input type="text" id="batdau" class="form-control" name="batdau">
                    </div>
                    <div class="col-md-6">
                        <label>Kết thúc</label>
                        <input type="text" id="ketthuc" class="form-control" name="ketthuc">
                    </div>
                  </div>
                </div></div>

           <div class="form-footer">
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Thêm </button>
             </div>

         </form>
        </div>
      </div>
    </div>


    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Danh Sách Mùa Vụ</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên vụ mùa</th>
                        <th>Bắt đầu</th>
                        <th> Kết thúc</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($mua_vu as $mv)
                    <tr>
                        <td>{{ $mv->id }}</td>
                        <td>{{ $mv->ten }}</td>
                        <td>{{ date('d-m-Y', strtotime($mv->bat_dau))}}</td>
                        <td>{{ date('d-m-Y', strtotime($mv->ket_thuc))}}</td>



                    </tr>
                    @endforeach


                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
  </div>

  </div>


  @endsection
