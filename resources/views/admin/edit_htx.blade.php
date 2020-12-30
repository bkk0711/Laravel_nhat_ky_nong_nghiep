@extends('admin_layout')
@section('title', 'Chỉnh sửa hợp tác xã')
@section('admin_content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Chỉnh sửa : {{$htx->ten}}</h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('edit_htx')}}" method="post" enctype="multipart/form-data">
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
                 <div class="form-group last">
                     <label class="col-sm-3 control-label">Chủ nhiệm</label>
                     <div class="col-sm-9">
                      <select name="cn" class="form-control">
                          @foreach ($chu_nhiem as $cn)
                          <?php
                          $h = DB::table('tbl_htx')->where('chu_nhiem', $cn->id)->count();
                          ?>
                          @if ($cn->id == $htx->chu_nhiem)
                          <option value="{{$cn->id}}" selected>{{$cn->name}}</option>
                          @endif
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
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Sửa Hợp Tác Xã</button>
                   </div>

                        </div>

               </form></div>
    </div>
</div>


@endsection
