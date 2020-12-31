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

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Danh Sách giống</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
               <table id="data-buttons" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Nguồn gốc</th>
                        <th>Số lượng </th>
                        <th>Đơn Giá</th>
                        <th>HTX</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($giong as $g)
                    <tr>
                        <td>{{ $g->id }}</td>
                      <td>{{ $g->ten }}</td>


                        <td>{{ $g->nguon_goc}}</td>
                        <td>{{ number_format($g->so_luong) }} Kg</td>
                        <td>{{ number_format($g->don_gia) }} VNĐ</td>
                        <td>
                            <?php
                            $h = DB::table('tbl_htx')->where('id', $g->id_htx)->first();
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
</div> </div>
@endsection
