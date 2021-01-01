@extends('admin_layout')
@section('title', 'Hợp tác xã')
@section('admin_content')
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
    <!-- Large modal -->
    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#large-model">Thêm Hợp Tác Xã</button>
    <hr/>
    <!-- Modal dialog-->
        <div id ="large-model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-close"></i></button>
                        <h4 class="modal-title" id="myLargeModalLabel">Thêm Hợp Tác Xã</h4>
                    </div>

      <div class="panel-body">
      <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('ds_htx')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
           <div class="form-group">
               <label class="col-sm-3 control-label">Tên hợp tác xã</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control" name="ten">
               </div>
           </div>

           <div class="form-group">
               <label class="col-sm-3 control-label">Mã Số thuế</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="mst">
               </div>
           </div>
           <div class="form-group last">
               <label class="col-sm-3 control-label">Chủ nhiệm</label>
               <div class="col-sm-9">
                <select name="cn" class="form-control">
                    @foreach ($chu_nhiem as $cn)
                    <?php
                    $h = DB::table('tbl_htx')->where('chu_nhiem', $cn->id)->count();
                    ?>
                    @if ($h == 0)
                    <option value="{{$cn->id}}">{{$cn->name}}</option>
                    @endif

                    @endforeach

                </select>
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Địa chỉ</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control" name="diachi">
               </div>
           </div>
           <div class="form-group last">
               <label class="col-sm-3 control-label">Số điện thoại</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control" name="phone">
               </div>
           </div>

           <div class="form-footer">
           <div class="modal-footer">
           <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Thêm Hợp Tác Xã</button>
             </div>

                  </div>

         </form></div>


                                                </div><!--modal-content -->
                                            </div><!-- modal-dialog -->
                                        </div><!-- modal -->

    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Danh Sách Hợp Tác Xã </h3>
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
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($htx as $h)
                <tr>
                    <td>{{$h->id}}</td>
                    <td>{{$h->ten}}</td>
                    <td>{{$h->ma_so_thue}}</td>
                    @if ($chu_nhiem->where('id',$h->chu_nhiem)->first()->name)
                    <td>{{($chu_nhiem->where('id',$h->chu_nhiem)->first())->name}}</td>
                    @else
                        <td>Chưa có chủ nhiệm</td>
                    @endif
                    <td>{{$h->dia_chi}}</td>
                    <td>{{$h->so_dien_thoai}}</td>
                    <td><a href="{{URL::to('edit_htx/'.$h->id)}}" class="btn-sm btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></a>
                        <a href="{{URL::to('del_htx/'.$h->id)}}" class="btn-sm btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i></a></a>
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
