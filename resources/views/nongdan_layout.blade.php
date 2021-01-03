<?php
 $admin = Session::get('admin');
 $user = DB::table('tbl_users')->where('username', $admin)->first();
        if(empty($admin)){
          header('location: '.URL::to("/").'');
          exit();
        }

  ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>@yield('title') | Nhật Ký Nông Nghiệp </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.png')}}">
    <!--Bootstrap Css-->
    <link href="{{ asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/plugins/date-time-pickers/css/flatpicker-airbnb.css')}}" rel="stylesheet" type="text/css"/>
    <!--Main Style Css-->
    <link href="{{ asset('public/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <!--Responsive Css-->
    <link href="{{ asset('public/assets/css/responsive.css')}}" rel="stylesheet" type="text/css"/>
    <!--Icons Css-->
    <link href="{{ asset('public/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('public/assets/js/modernizr.min.js')}}"></script>
     <!--Data Tables -->
     <link href="{{ asset('public/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
     <link href="{{ asset('public/assets/plugins/bootstrap-datatable/css/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
     <link href="{{ asset('public/assets/plugins/bootstrap-datatable/css/select.bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/waves.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('public/assets/js/app-script.js') }}"></script>
         <!--Date & Time Picker-->
		<script src="{{ asset('public/assets/plugins/date-time-pickers/js/flatpickr.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/date-time-pickers/js/date-time-picker-script.js') }}"></script>
    <!--Data Tables -->
    <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js') }}"></script>
         <script src="{{ asset('public/assets/plugins/bootstrap-datatable/js/dataTables.select.min.js') }}"></script>
    </head>

    <body>
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Start Menu -->
            <aside class="sidebar-left do-nicescrol" style="background: #3ca03c;background-image: linear-gradient(45deg, rgb(185, 193, 27), rgb(69, 182, 73));overflow: initial !important;">
              <nav class="navbar">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false" style="border: 1px solid #f5f7fa;">
                    <span class="sr-only" style="background: white; ">Toggle navigation</span>
                    <span class="icon-bar" style="background: white; "></span>
                    <span class="icon-bar" style="background: white; "></span>
                    <span class="icon-bar" style="background: white; "></span>
                    </button>
                    <div class="logo">
                      <a href="index.html"><img src="{{ URL::to('public/assets/images/logo.png') }}">
                       <span class="text-white">Nhật Ký </span></a>
                     </div>
                  </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="{{ URL::to('public/assets/images/user.png') }}" alt="" class="thumb-md img-circle">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="javascript:void();" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ $user->name }}
                                    </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ URL::to('logout') }}"><i class="icon-power"></i>Logout</a></li>
                                </ul>
                            </div>
                            <p class="designation m-0">Nông Dân</p>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                      <li class="treeview">
                        <a href="{{ URL::to('dashboard') }}" class="waves-effect">
                        <i class="icon-home"></i> <span>Dashboard</span>
                        </a>
                      </li>
                      <li class="treeview">
                        <a href="{{URL::to('nd_htx')}}" class="waves-effect">
                        <i class="fa fa-book"></i> <span> Danh sách HTX</span>
                        </a>
                      </li>
                      <li class="treeview">
                        <a href="{{URL::to('nd_thua')}}" class="waves-effect">
                        <i class="fa fa-book"></i> <span> Quản lý thửa</span>
                        </a>
                      </li>
                      <li class="treeview">
                        <a href="{{URL::to('lam_dat')}}" class="waves-effect">
                        <i class="fa fa-book"></i> <span>Nhật ký làm đất</span>
                        </a>
                      </li>
                      <li class="treeview">
                        <a href="{{URL::to('xuong_giong')}}" class="waves-effect">
                        <i class="fa fa-book"></i> <span>Nhật ký xuống giống</span>
                        </a>
                      </li>
                      <li class="treeview">
                        <a href="{{URL::to('nhan_vat_tu')}}" class="waves-effect">
                        <i class="fa fa-book"></i> <span>Nhật ký nhận vật tư</span>
                        </a>
                      </li>
                      <li class="treeview">
                        <a href="{{URL::to('su_dung_vat_tu')}}" class="waves-effect">
                        <i class="fa fa-book"></i> <span>Nhật ký sử dụng vật tư</span>
                        </a>
                      </li>
                      <li class="treeview">
                        <a href="{{URL::to('nd_info')}}" class="waves-effect">
                        <i class="icon-user"></i> <span>Cập nhật thông tin</span>
                        </a>
                      </li>




                    </ul>
                  </div>
                  <!-- /.navbar-collapse -->
              </nav>
            </aside>
           <!-- End Menu-->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

          <!-- Header Start -->
            <header class="topbar">
                <!-- Mobile Menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
					<div class="pull-left toggle-menu-icon">
                                <i class="fa fa-bars menu-icon"></i>
                            </div>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                      <li><a href="{{ URL::to('logout') }}"><i class="icon-power"></i> Đăng Xuất</a></li>
                            </ul>

                        <!--/.nav-collapse -->
                    </div>
                </div>
            </header>
            <!-- Header End -->

			<!-- Page Breadcrumb -->
            <div class="row breadcrumb-area">
                <div class="col-sm-12">
                    <h4 class="pull-left text-uppercase">@yield('title')</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="javascript:void();" class="text-info">Admin Panel</a></li>
                        <li class="active">@yield('title')</li>
                    </ol>
                </div>
            </div>
			   <!-- End Page Breadcrumb -->

                 <!--Main Page Content Start Here-->
                 @yield('nongdan_content')
                 <!--End Page Content Start Here-->

                    </div> <!-- container -->
                </div> <!-- content -->

                <footer class="footer text-right">
                    Nhật ký sản xuất nông sản
                </footer>
                <!--Back To Button-->
                 <a class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
                <!--End Back To Button-->
            </div><!-- content Page-->

        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

        <!-- Main  Scripts-->

        <script>
          $('.sidebar-menu').SidebarNav();
          $(".do-nicescrol").niceScroll({
            cursorcolor:"rgba(137, 150, 162, 0.3)",
            cursorwidth:"6px",
            cursorborder:"0px solid rgba(45, 53, 60, 0.3)",
           });
        </script>

              <script>
                $(document).ready(function() {

                    //buttons data tables
                    $('#data-buttons').DataTable( {
                    dom: 'Bfrtip',
                    responsive: true,
                        buttons: [
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5'

                        ]
                    } );
                    $('#data0').DataTable( {
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
	</body>

</html>
