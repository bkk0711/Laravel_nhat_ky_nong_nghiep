@extends('htx_layout')
@section('title', 'Loại Vật Tư')
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

          <h3 class="panel-title"> Thêm Loại Vật Tư</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal striped-rows" method="POST" action="{{ URL::to('htx_loai_vattu') }}">
            {{csrf_field()}}
           <div class="form-group">
               <label class="col-sm-3 control-label">Loại Vật Tư</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control" name="loai">
               </div>
           </div>

           <div class="form-footer">
                 <button type="submit" class="btn btn-success waves-effect waves-light">
                     <i class="fa fa-check-square-o"></i> THÊM</button>
             </div>

         </form>
        </div>
      </div>


    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Danh Sách Loại Vật Tư</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Loại vật tư</th>
                        <th>Người thêm</th>
                        <th> Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($loai as $lvt)
                    <tr>
                        <td>{{ $lvt->id }}</td>
                        <td>{{ $lvt->loai }}</td>
                        @if ($lvt->id_htx == 0)
                        <td>Admin</td>
                        <td>Không thể thao tác</td>
                        @else
                        <td>{{ (DB::table('tbl_htx')->where('id',$lvt->id_htx)->first())->ten }}</td>
                        <td> <a class="btn-sm btn-danger" href="{{URL::to('xoa_loai_vattu/'.$lvt->id)}}"><i class="fa fa-window-close" aria-hidden="true"></i></a>
                        </a>
                    </td>
                        @endif


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
