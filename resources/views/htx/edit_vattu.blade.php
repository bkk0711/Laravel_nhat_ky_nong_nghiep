@extends('htx_layout')
@section('title', 'Chỉnh sửa vật tư')
@section('HTX_content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Danh Sách Vật Tư </h3>
        </div>
<div class="panel-body">
    <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('edit_vattu')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$vattu->id}}" >
         <div class="form-group">
             <label class="col-sm-3 control-label">Tên vật tư</label>
             <div class="col-sm-9">
               <input type="text" class="form-control" name="ten" value="{{$vattu->ten}}">
             </div>
         </div>

         <div class="form-group">
             <label class="col-sm-3 control-label">Loại vật tư</label>
             <div class="col-sm-9">
              <select name="loai" class="form-control" >
                   @foreach ($loai as $l)
                   @if ($l->id == $vattu->loai)
                   <option value="{{$l->id}}" selected> {{$l->loai}}</option>
                   @else
                   <option value="{{$l->id}}"> {{$l->loai}}</option>
                   @endif

                   @endforeach

              </select>
             </div>
         </div>
         <div class="form-group last">
             <label class="col-sm-3 control-label">Nhà cung cấp</label>
             <div class="col-sm-9">
              <select name="ncc" class="form-control">
                  @foreach ($ncc as $n)
                  @if ($n->id == $vattu->id_ncc)
                  <option value="{{$n->id}}" selected>{{$n->TenNCC}}</option>
                  @else
                  <option value="{{$n->id}}">{{$n->TenNCC}}</option>
                  @endif

                  @endforeach

              </select>
             </div>
         </div>
         <div class="form-group">
             <label class="col-sm-3 control-label">Hoạt chất</label>
             <div class="col-sm-9">
               <textarea class="form-control" name="hoatchat" rows="2">{{$vattu->hoat_chat}}</textarea>
             </div>
         </div>
         <div class="form-group last">
             <label class="col-sm-3 control-label">Đối tượng</label>
             <div class="col-sm-9">
                 <textarea name="doituong" class="form-control" rows="2">{{$vattu->doi_tuong}}</textarea>

             </div>
         </div>
         <div class="form-group last">
             <label class="col-sm-3 control-label">Hướng dẫn sử dụng</label>
             <div class="col-sm-9">
              <textarea class="form-control" name="hdsd" rows="2">{{$vattu->hdsd}}</textarea>
             </div>
         </div>

      <div class="form-group">
          <label class="col-sm-3 control-label">Số lượng</label>
          <div class="col-sm-9">
            <input type="number" class="form-control"  name="so_luong" value="{{$vattu->so_luong}}">
          </div>
      </div>
      <div class="form-group">
          <label class="col-sm-3 control-label">Đơn giá</label>
          <div class="col-sm-9">
            <input type="number" class="form-control"  name="don_gia" step="0.1" value="{{$vattu->don_gia}}">
          </div>
      </div>
         <div class="form-group last">
             <label class="col-sm-3 control-label">Ảnh <p style="color:red"><small> Để trống nếu không muốn cập nhật ảnh</small></p> </label>

             <div class="col-sm-9">
              <input type="file" name="image" class="form-control">

             </div>
         </div>
         <div class="form-footer">
         <div class="modal-footer">
         <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Sửa Vật Tư</button>
           </div>

                </div>

       </form></div>


    </div></div></div>
@endsection
