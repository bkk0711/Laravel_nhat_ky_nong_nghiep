@extends('htx_layout')
@section('title', 'Quản lý giống')
@section('HTX_content')
<div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Sửa Giống : {{$giong->ten}}</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal form-bordered striped-rows" method="POST" action="{{ URL::to('edit_giong') }}">
<input type="hidden" name="id" value="{{$giong->id}}">
           <div class="form-group">
               <label class="col-sm-3 control-label">Tên Giống <font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="ten" value="{{$giong->ten}}">

               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Nguồn gốc<font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="nguon_goc" value="{{$giong->nguon_goc}}">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Đơn giá ( VNĐ)<font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                <input type="number" class="form-control" name="don_gia" step="0.1" min="1" value="{{$giong->don_gia}}">

               </div>
           </div>
           <div class="form-group">
            <label class="col-sm-3 control-label">Số lượng ( kg)<font color="red"><small>(*)</small></font></label>
            <div class="col-sm-9">
             <input type="number" class="form-control" name="so_luong" step="0.1" min="1" value="{{$giong->so_luong}}">

            </div>
        </div>

           {{ csrf_field() }}
           <div class="form-footer">
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Sửa</button>
             </div>

         </form>
        </div>
      </div>
    </div>

  </div>
@endsection
