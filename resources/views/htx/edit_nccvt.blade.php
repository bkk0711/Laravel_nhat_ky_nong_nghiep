@extends('htx_layout')
@section('title', 'Chỉnh Sửa Nhà Cung Cấp Vật Tư')
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
          <h3 class="panel-title"> Chỉnh sửa : {{$ncc->TenNCC}}</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal form-bordered striped-rows" method="POST" action="{{ URL::to('edit_htx_ncc_vattu') }}">
<input type="hidden" name="id" value="{{$ncc->id}}">
           <div class="form-group">
               <label class="col-sm-3 control-label">Mã nhà cung cấp <font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                 <input type="text" class="form-control" name="ma_ncc" value="{{$ncc->MaNCC}}">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Tên nhà cung cấp <font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                 <input type="text" class="form-control"  name="ten_ncc" value="{{$ncc->TenNCC}}">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Địa chỉ </label>
               <div class="col-sm-9">
                 <input type="text" class="form-control"  name="diachi" value="{{$ncc->DiaChi}}">
               </div>
           </div>
           <div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control"  name="email" value="{{$ncc->Email}}">
            </div>
        </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Số điện thoại</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control"  name="sdt" value="{{$ncc->SDT}}">
               </div>
           </div>

           <div class="form-group last">
               <label class="col-sm-3 control-label">Website</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control"  name="website" value="{{$ncc->Website}}">
               </div>
           </div>
           {{ csrf_field() }}
           <div class="form-footer">
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> SỬA NHÀ CUNG CẤP</button>
             </div>

         </form>
        </div>
      </div>
    </div>
</div>

@endsection
