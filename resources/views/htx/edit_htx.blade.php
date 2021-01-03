@extends('HTX_layout')
@section('title', 'Cập nhật hợp tác xã')
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
            <h3 class="panel-title">Cập nhật thông tin hợp tác xã</h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('cn_htx')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$htx->id}}">
                 <div class="form-group">
                     <label class="col-sm-3 control-label">Tên hợp tác xã</label>
                     <div class="col-sm-9">
                       <input type="text" class="form-control" name="ten" value="{{$htx->ten}}">
                     </div>
                 </div>

                 <div class="form-group">
                     <label class="col-sm-3 control-label">Mã Số thuế</label>
                     <div class="col-sm-9">
                      <input type="text" class="form-control" name="mst" value="{{$htx->ma_so_thue}}">
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="col-sm-3 control-label">Địa chỉ</label>
                     <div class="col-sm-9">
                       <input type="text" class="form-control" name="diachi" value="{{$htx->dia_chi}}">
                     </div>
                 </div>
                 <div class="form-group last">
                     <label class="col-sm-3 control-label">Số điện thoại</label>
                     <div class="col-sm-9">
                       <input type="text" class="form-control" name="phone" value="{{$htx->so_dien_thoai}}">
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
