@extends('admin_layout')
@section('title', 'Nhà Cung Cấp Vật Tư')
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
      {{-- <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"> Thêm Nhà Cung Cấp Vật Tư</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal form-bordered striped-rows" method="POST" action="{{ URL::to('ncc_vattu') }}">

           <div class="form-group">
               <label class="col-sm-3 control-label">Mã nhà cung cấp <font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                 <input type="text" class="form-control" name="ma_ncc">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Tên nhà cung cấp <font color="red"><small>(*)</small></font></label>
               <div class="col-sm-9">
                 <input type="text" class="form-control"  name="ten_ncc">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Địa chỉ </label>
               <div class="col-sm-9">
                 <input type="text" class="form-control"  name="diachi">
               </div>
           </div>
           <div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control"  name="email">
            </div>
        </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Số điện thoại</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control"  name="sdt">
               </div>
           </div>

           <div class="form-group last">
               <label class="col-sm-3 control-label">Website</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control"  name="website">
               </div>
           </div>
           {{ csrf_field() }}
           <div class="form-footer">
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> THÊM NHÀ CUNG CẤP</button>
             </div>

         </form>
        </div>
      </div>
    </div> --}}
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Danh Sách Nhà Cung Cấp Vật Tư </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã NCC</th>
                        <th>Tên NCC</th>
                        <th>Địa chỉ</th>
                        <th>SDT</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Người thêm</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($ncc as $nc)
                    <tr>
                        <td>{{ $nc->id }}</td>
                        <td>{{ $nc->MaNCC }}</td>
                        <td>{{ $nc->TenNCC }}</td>
                        <td>{{ $nc->DiaChi }}</td>
                        <td>{{ $nc->SDT }}</td>
                        <td>{{ $nc->Email }}</td>
                        <td>{{ $nc->Website }}</td>
                        @if ($nc->id_htx == 0)
                        <td>Admin</td>
                        @else
                        <td>{{ (DB::table('tbl_htx')->where('id',$nc->id_htx)->first())->ten }}</td>
                        @endif



                    </tr>
                    @endforeach


                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
</div></div>
@endsection
