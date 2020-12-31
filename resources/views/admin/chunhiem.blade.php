@extends('admin_layout')
@section('title', 'Chủ Nhiệm HTX')
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
    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#large-model">Thêm Chủ Nhiệm HTX</button>
    <hr/>
    <!-- Modal dialog-->
        <div id ="large-model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-close"></i></button>
                        <h4 class="modal-title" id="myLargeModalLabel">Thêm Chủ Nhiệm HTX</h4>
                    </div>

      <div class="panel-body">
      <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('chu_nhiem')}}" method="post">
          {{ csrf_field() }}
           <div class="form-group">
               <label class="col-sm-3 control-label">Tên chủ nhiệm</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control" name="ten">
               </div>
           </div>

           <div class="form-group">
               <label class="col-sm-3 control-label">Tên đăng nhập</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="user">
               </div>
           </div>
           <div class="form-group last">
               <label class="col-sm-3 control-label">Mật khẩu</label>
               <div class="col-sm-9">
                <input type="password" class="form-control" name="pass">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Email</label>
               <div class="col-sm-9">
                 <input type="email" class="form-control" name="email">
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
           <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Thêm chủ nhiệm</button>
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
                <h3 class="panel-title">Danh Sách Chủ Nhiệm HTX</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Tên đăng nhập</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Hợp tác xã</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($user as $value)
                    <?php
                    $h = DB::table('tbl_htx')->where('chu_nhiem', $value->id)->first();
                    ?>
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->username}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->sdt}}</td>
                        @if($h)
                        <td>{{$h->ten}}</td>
                        @else
                        <td>Chưa thêm vào HTX</td>
                        @endif

                        <td><a href="{{URL::to('edit_chu_nhiem/'.$value->id)}}" class="btn-sm btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></a>
                            <a href="{{URL::to('x_chu_nhiem/'.$value->id)}}" class="btn-sm btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i></a></a>
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
