@extends('admin_layout')
@section('title', 'Vật Tư')
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
    {{-- <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#large-model">Thêm Vật tư</button> --}}
    {{-- <hr/> --}}
    <!-- Modal dialog-->
                                        <div id ="large-model" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-close"></i></button>
                                                        <h4 class="modal-title" id="myLargeModalLabel">Thêm Vật Tư</h4>
                                                    </div>

      <div class="panel-body">
      <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('vattu')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
           <div class="form-group">
               <label class="col-sm-3 control-label">Tên vật tư</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control" name="ten">
               </div>
           </div>

           <div class="form-group">
               <label class="col-sm-3 control-label">Loại vật tư</label>
               <div class="col-sm-9">
                <select name="loai" class="form-control" >
                     @foreach ($loai as $l)
                 <option value="{{$l->id}}"> {{$l->loai}}</option>
                     @endforeach

                </select>
               </div>
           </div>
           <div class="form-group last">
               <label class="col-sm-3 control-label">Nhà cung cấp</label>
               <div class="col-sm-9">
                <select name="ncc" class="form-control">
                    @foreach ($ncc as $n)
                <option value="{{$n->id}}">{{$n->TenNCC}}</option>
                    @endforeach

                </select>
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Hoạt chất</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control" name="hoatchat">
               </div>
           </div>
           <div class="form-group last">
               <label class="col-sm-3 control-label">Đối tượng</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control" name="doituong">
               </div>
           </div>
           <div class="form-group last">
               <label class="col-sm-3 control-label">Hướng dẫn sử dụng</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control" name="hdsd">
               </div>
           </div>
           <div class="form-group last">
               <label class="col-sm-3 control-label">Ảnh </label>
               <div class="col-sm-9">
                <input type="file" name="image" class="form-control">

               </div>
           </div>
           <div class="form-footer">
           <div class="modal-footer">
           <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Thêm Vật Tư</button>
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
                <h3 class="panel-title">Danh Sách Vật Tư </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thumbnail</th>
                        <th>Tên</th>
                        <th>Loại</th>
                        <th>Nhà cung cấp</th>
                        <th>Hoạt Chất</th>
                        <th>Đối Tượng</th>
                        <th>HDSD</th>
                        <th>Số lượng </th>
                        <th>Đơn Giá</th>
                        <th>HTX</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($vattu as $vt)
                    <tr>
                        <td>{{ $vt->id }}</td>
                        @if ($vt->img)
                        <td><a href="{{URL::to('storage/app/'.$vt->img)  }}" target="_blank" rel="noopener noreferrer"><img src="{{URL::to('storage/app/'.$vt->img)  }}" width="80px"></a></td>
                        @else
                           <td>No IMG</td>
                        @endif<td>{{ $vt->ten }}</td>
                        @if ($loai->where('id',$vt->loai)->first() )
                        <td>{{ ($loai->where('id',$vt->loai))->first()->loai }}</td>
                       @else
                       <td>Chưa phân loại</td>
                       @endif
                       @if ($ncc->where('id',$vt->id_ncc)->first())
                       <td>{{ ($ncc->where('id',$vt->id_ncc))->first()->TenNCC }}</td>
                       @else
                       <td>Chưa rõ nhà cung cấp</td>
                       @endif
                        <td>{{ $vt->hoat_chat }}</td>
                        <td>{{ $vt->doi_tuong }}</td>
                        <td>{{ $vt->hdsd }}</td>
                        <td>{{ number_format($vt->so_luong) }} Kg</td>
                        <td>{{ number_format($vt->don_gia) }} VNĐ</td>
                        <td>
                            <?php
                            $h = DB::table('tbl_htx')->where('id', $vt->id_htx)->first();
                            ?>
                            {{$h->ten}}
                        </td>
                    {{-- <td> <a class="btn-sm btn-danger" href="{{URL::to('')}}"><i class="fa fa-window-close" aria-hidden="true"></i></a>
                            <a class="btn-sm btn-warning" href="{{URL::to('')}}"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                            </a></td> --}}

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
