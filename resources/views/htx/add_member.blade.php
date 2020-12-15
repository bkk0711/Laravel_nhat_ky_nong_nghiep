@extends('htx_layout')
@section('title', 'Thêm Thành Viên HTX')
@section('HTX_content')
@if ($total == 0)
<div class="panel panel-default">
    <div class="panel-heading">

      <h3 class="panel-title"> Tạo mới thành viên</h3>
    </div>
    <div class="panel-body">
      <h3>
        Bạn không thể thêm thành viên. Do bạn chưa được bổ nhiệm làm chủ nhiệm HTX nào
      </h3>
    </div>
</div>
@else
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

      <h3 class="panel-title"> Tạo mới thành viên</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal form-bordered striped-rows" method="POST" action="{{ URL::to('add_member') }}">
        {{csrf_field()}}
       <div class="form-group">
           <label class="col-sm-3 control-label">Tên đăng nhập</label>
           <div class="col-sm-9">
             <input type="text" class="form-control" name="user">
           </div>
       </div>
       <div class="form-group">
        <label class="col-sm-3 control-label">Mật Khẩu</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" name="pass">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Hợp Tác Xã</label>
        <div class="col-sm-9">
    <select name="htx" class="form-control">
        @foreach ($htx as $vl)
            <option value="{{$vl->id}}">{{$vl->ten}}   </option>
        @endforeach
    </select>
</div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Họ Tên</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="fullname">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Email</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" name="email">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Số điện thoại</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="SDT">
    </div>
</div>


       <div class="form-footer">
             <button type="submit" class="btn btn-success waves-effect waves-light">
                 <i class="fa fa-check-square-o"></i> THÊM</button>
         </div>

     </form>
    </div></div>

<br/>
<div class="panel panel-default">
    <div class="panel-heading">

      <h3 class="panel-title"> Thêm Thành Viên Đã Có Tài Khoản</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal form-bordered striped-rows" method="POST" action="{{ URL::to('add_member') }}">
        {{csrf_field()}}
       <div class="form-group">
           <label class="col-sm-3 control-label">Tên đăng nhập </label>
           <div class="col-sm-9">
             <input type="text" class="form-control" name="tai_khoan">
           </div>
       </div>
       <div class="form-group">
        <label class="col-sm-3 control-label">Hợp Tác Xã</label>
        <div class="col-sm-9">
    <select name="htx" class="form-control">
        @foreach ($htx as $vl)
            <option value="{{$vl->id}}">{{$vl->ten}}   </option>
        @endforeach
    </select>
</div>
</div>
       <div class="form-footer">
             <button type="submit" class="btn btn-success waves-effect waves-light">
                 <i class="fa fa-check-square-o"></i> THÊM</button>
         </div>

     </form>
    </div></div>


    @endif
@endsection
