@extends('admin_layout')
@section('title', 'Loại Vật Tư')
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
            
          <h3 class="panel-title"> Thêm Loại Vật Tư</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal striped-rows" method="POST" action="{{ URL::to('loai_vattu') }}">
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
                    </tr>
                </thead>
            
                <tbody>
                    @foreach ($loai as $lvt)
                    <tr>
                        <td>{{ $lvt->id }}</td>
                        <td>{{ $lvt->loai }}</td>
                        
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