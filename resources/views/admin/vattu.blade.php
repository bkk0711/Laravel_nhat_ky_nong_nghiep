@extends('admin_layout')
@section('title', 'Vật Tư')
@section('admin_content')
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"> Thêm Vật Tư</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal form-bordered striped-rows">
           <div class="form-group">
               <label class="col-sm-3 control-label">First Name</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Last Name</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Email</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control">
               </div>
           </div>
           <div class="form-group">
               <label class="col-sm-3 control-label">Password</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control">
               </div>
           </div>
           <div class="form-group last">
               <label class="col-sm-3 control-label">Confirm Password</label>
               <div class="col-sm-9">
                 <input type="text" class="form-control">
               </div>
           </div>
           <div class="form-footer">
                 <button type="submit" class="btn btn-danger waves-effect waves-light"><i class="fa fa-times"></i> CANCEL</button>
                 <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check-square-o"></i> SAVE</button>
             </div>

         </form>
        </div>
      </div>
    </div>
  </div>
@endsection