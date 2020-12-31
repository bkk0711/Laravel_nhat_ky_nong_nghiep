@extends('admin_layout')
@section('title', 'Danh Sách Nông Dân')
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Danh Sách Nông Dân</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Tên đăng nhập</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Hợp tác xã</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($nongdan as $value)
                    <?php
                    $hm = DB::table('tbl_htx_member')->where('id_user', $value->id)->get();
                    ?>
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->username}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->sdt}}</td>
                        @if($hm->count() > 0)
                        <td>
                        @foreach ($hm as $i)
                        <?php
                        $h = DB::table('tbl_htx')->where('id', $i->id_htx)->first();
                        ?>
                           <span class="label label-success">{{$h->ten}}</span>
                        @endforeach
                        </td>
                        @else
                        <td>Chưa thêm vào HTX</td>
                        @endif

                        <td><a href="{{URL::to('edit_nong_dan/'.$value->id)}}" class="btn-sm btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></a>
                            <a href="{{URL::to('x_nong_dan/'.$value->id)}}" class="btn-sm btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i></a></a>
                        </td>
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
