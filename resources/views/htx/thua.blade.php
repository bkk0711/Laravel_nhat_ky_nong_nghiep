@extends('htx_layout')
@section('title', 'Quản lý thừa')
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
          <h3 class="panel-title">Thêm vụ mùa</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('thua')}}" method="POST">

            @csrf

            <div class="form-group">
                <label class="col-sm-3 control-label">Người sở hữu</label>
                <div class="col-sm-9">
                 <select name="id_user" class="form-control">
                    @foreach ($htx as $h)
                    <?php
                    $user_htx = DB::table('tbl_htx_member')->where('id_htx', $h->id)->get();
                    ?>
                     @foreach ($user_htx as $u)
                    <?php
                    $u_htx = DB::table('tbl_users')->where('id', $u->id_user)->first();
                    ?>
                    <option value="{{$u_htx->id}}"> {{$u_htx->name}}</option>
                    @endforeach
                    @endforeach

                 </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Diện tích ( <font color="red"><b> ㎡ </b></font>)</label>
                <div class="col-sm-9">
                <input type="number" name="dien_tich" id="" step="0.1" class="form-control">
                </div></div>

            <div class="form-group">
                            <label class="col-sm-3 control-label">Hợp tác xã</label>
                            <div class="col-sm-9">
                            <select name="id_htx" class="form-control">
                                @foreach ($htx as $h)
                                <option value="{{$h->id}}"> {{$h->ten}}</option>

                                @endforeach

                            </select>
                            </div>
                        </div>

           <div class="form-footer">
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Thêm </button>
             </div>

         </form>
        </div>
      </div>
    </div>


    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Danh Sách Thừa Ruộng </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Chủ sở hữu </th>
                        <th>diện tích </th>
                        <th>hành động</th>
                    </tr>
                </thead>

                <tbody>
                        <?php $i = 0; ?>
                    @foreach ($thua as $t)
                    <?php
                    $u = DB::table('tbl_users')->where('id', $t->id_user)->first();
                    ?>
                        <tr>
                            <td>{{$i +=1 }} - Thừa </td>
                            <td>{{$u->name}}</td>
                            <td>{{number_format($t->dien_tich)}} <font color="red"><b> ㎡ </b></font></td>
                            <td>Xoa </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
  </div>

  </div>


  @endsection
