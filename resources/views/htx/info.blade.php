@extends('htx_layout')
@section('title', 'Cập nhật thông tin cá nhân')
@section('HTX_content')
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
            <h3 class="panel-title">Cập nhật thông tin cá nhân</h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('admin_info')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$u->id}}">
                 <div class="form-group">
                     <label class="col-sm-3 control-label">Họ Tên</label>
                     <div class="col-sm-9">
                       <input type="text" class="form-control" name="ten" value="{{$u->name}}">
                     </div>
                 </div>
                 <div class="form-group last">
                     <label class="col-sm-3 control-label">Mật khẩu</label>
                     <div class="col-sm-9">
                      <input type="password" class="form-control" name="pass" >
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-sm-3 control-label">Email</label>
                     <div class="col-sm-9">
                       <input type="email" class="form-control" name="email" value="{{$u->email}}">
                     </div>
                 </div>
                 <div class="form-group last">
                     <label class="col-sm-3 control-label">Số điện thoại</label>
                     <div class="col-sm-9">
                       <input type="text" class="form-control" name="phone" value="{{$u->sdt}}">
                     </div>
                 </div>

                 <div class="form-footer">
                 <div class="modal-footer">
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Cập nhật</button>
                   </div>

                        </div>

               </form></div>
    </div>
</div>


@endsection
