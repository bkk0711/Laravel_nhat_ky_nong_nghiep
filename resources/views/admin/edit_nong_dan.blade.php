@extends('admin_layout')
@section('title', 'Chỉnh sửa nông dân')
@section('admin_content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Chỉnh sửa : {{$nd->name}}</h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('edit_nong_dan')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$nd->id}}">
                 <div class="form-group">
                     <label class="col-sm-3 control-label">Tên chủ nhiệm</label>
                     <div class="col-sm-9">
                       <input type="text" class="form-control" name="ten" value="{{$nd->name}}">
                     </div>
                 </div>

                 <div class="form-group">
                     <label class="col-sm-3 control-label">Tên đăng nhập</label>
                     <div class="col-sm-9">
                      <input type="text" class="form-control" name="user" value="{{$nd->username}}">
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
                       <input type="email" class="form-control" name="email" value="{{$nd->email}}">
                     </div>
                 </div>
                 <div class="form-group last">
                     <label class="col-sm-3 control-label">Số điện thoại</label>
                     <div class="col-sm-9">
                       <input type="text" class="form-control" name="phone" value="{{$nd->sdt}}">
                     </div>
                 </div>

                 <div class="form-footer">
                 <div class="modal-footer">
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Sửa nông dân</button>
                   </div>

                        </div>

               </form></div>
    </div>
</div>


@endsection
