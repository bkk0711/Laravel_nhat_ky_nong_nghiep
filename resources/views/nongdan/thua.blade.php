@extends('nongdan_layout')
@section('title', 'Quản lý thừa')
@section('nongdan_content')

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
          <h3 class="panel-title">Thêm thửa ruộng</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('nd_thua')}}" method="POST">

            @csrf

            <div class="form-group">
                <label class="col-sm-3 control-label">Tên thửa ruộng</label>
                <div class="col-sm-9">
                    <input type="text" name="ten"  class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Diện tích ( <font color="red"><b> ㎡ </b></font>)</label>
                <div class="col-sm-9">
                <input type="number" name="dien_tich" id="" step="0.1" class="form-control">
                </div></div>



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
                <h3 class="panel-title">Danh Sách Thửa Ruộng </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên thửa </th>
                        <th>diện tích </th>
                        <th>hành động</th>
                    </tr>
                </thead>

                <tbody>
                        <?php $i = 0; ?>
                    @foreach ($thua as $t)
                    <?php
                    ?>
                        <tr>
                            <td>{{$i +=1 }}</td>
                            <td>{{$t->ten}}</td>
                            <td>{{number_format($t->dien_tich)}} <font color="red"><b> ㎡ </b></font></td>
                            <td>
                                <a class="btn btn-xs btn-danger" href="{{URL::to('x_thua/'.$t->id)}}"><i class="fa fa-window-close" aria-hidden="true"></i></a>

                            <a class="btn btn-xs btn-warning" href="{{URL::to('e_thua/'.$t->id)}}"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                            </a> </td>
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
