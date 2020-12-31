@extends('htx_layout')
@section('title', 'Danh sách Thành Viên HTX')
@section('HTX_content')
@if ($total == 0)
<div class="panel panel-default">
    <div class="panel-heading">

      <h3 class="panel-title">Danh Sách Thành Viên</h3>
    </div>
    <div class="panel-body">
      <h3>
        Bạn không thể Xem thành viên. Do bạn chưa được bổ nhiệm làm chủ nhiệm HTX nào
      </h3>
    </div>
</div>
@else
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
@foreach ($htx as $h)
<script>
    $(document).ready(function() {

        //buttons data tables
        $('#data-buttons-{{$h->id}}').DataTable( {
        dom: 'Bfrtip',
        responsive: true,
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'

            ]
        } );


        //focus data table



    } );
    </script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Danh Sách HTX {{$h->ten}}</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
       <table id="data-buttons-{{$h->id}}" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Người dùng</th>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th> Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $i = 1;
            $user_htx = DB::table('tbl_htx_member')->where('id_htx', $h->id)->get();
            ?>
            @foreach ($user_htx as $u)
            <?php
            $u_htx = DB::table('tbl_users')->where('id', $u->id_user)->first();
            ?>
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $u_htx->name }}</td>
                <td>{{ $u_htx->username }}</td>
                <td>{{ $u_htx->email }}</td>
                <td>{{ $u_htx->sdt }}</td>
                 <td> <a class="btn btn-sm btn-danger" href="{{URL::to('x_member/'.$u->id_user)}}"><i class="fa fa-window-close" aria-hidden="true"></i></a>
                            <a class="btn btn-sm btn-warning" href="{{URL::to('edit_member/'.$u->id_user)}}"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                            </a></td>

            </tr>
            <?php
            $i++;
            ?>
            @endforeach


        </tbody>
    </table>
    </div>
</div>
</div>
@endforeach


    @endif
@endsection
