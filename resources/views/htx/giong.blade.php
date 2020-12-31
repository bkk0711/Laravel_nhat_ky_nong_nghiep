@extends('htx_layout')
@section('title', 'Quản lý giống')
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
          <h3 class="panel-title"> Thêm Giống</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal form-bordered striped-rows" method="POST" action="{{ URL::to('giong') }}">

           <div class="form-group">
               <label class="col-sm-3 control-label">Tên Giống <font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="ten">

               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Nguồn gốc<font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="nguon_goc">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Đơn giá ( VNĐ)<font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                <input type="number" class="form-control" name="don_gia" step="0.1" min="1">

               </div>
           </div>
           <div class="form-group">
            <label class="col-sm-3 control-label">Số lượng ( kg)<font color="red"><small>(*)</small></font></label>
            <div class="col-sm-9">
             <input type="number" class="form-control" name="so_luong" step="0.1" min="1">

            </div>
        </div>

           {{ csrf_field() }}
           <div class="form-footer">
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Thêm</button>
             </div>

         </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Danh sách giống lúa</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên giống lúa</th>
                        <th>Nguồn gốc </th>
                        <th>Đơn giá</th>
                        <th>Tồn</th>
                        <th>Thao tác</th>

                    </tr>
                </thead>

                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($giong as $g)
                    <tr>
                        <td> {{$i+=1}}</td>
                        <td> {{$g->ten}}</td>
                        <td>{{$g->nguon_goc}}</td>
                        <td>{{number_format($g->don_gia)}} VNĐ</td>
                        <td>{{number_format($g->so_luong)}} KG</td>
                        <td>
                            <a class="btn btn-sm btn-danger" href="{{URL::to('x_giong/'.$g->id)}}"><i class="fa fa-window-close" aria-hidden="true"></i></a>
                            <a class="btn btn-sm btn-warning" href="{{URL::to('edit_giong/'.$g->id)}}"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                        </td>
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
