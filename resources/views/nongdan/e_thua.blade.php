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
          <h3 class="panel-title">Sửa thửa ruộng</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal form-bordered striped-rows" action="{{URL::to('e_thua')}}" method="POST">

            @csrf
<input type="hidden" name="id" value="{{$thua->id}}">
            <div class="form-group">
                <label class="col-sm-3 control-label">Tên thửa ruộng</label>
                <div class="col-sm-9">
                    <input type="text" name="ten"  class="form-control" value="{{$thua->ten}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Diện tích ( <font color="red"><b> ㎡ </b></font>)</label>
                <div class="col-sm-9">
                <input type="number" name="dien_tich" id="" step="0.1" class="form-control" value="{{$thua->dien_tich}}">
                </div></div>



           <div class="form-footer">
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> Cập nhật </button>
             </div>

         </form>
        </div>
      </div>
    </div>


  </div>


  @endsection
