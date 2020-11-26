<?php
$admin = Session::get('admin');
        if(isset($admin)){
          header('location: '.URL::to("/dashboard").'');
          exit();
        }
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Đăng Nhập Vào Nhật Ký</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.png')}}">
        <!--Bootstrap Css-->
        <link href="{{ asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <!--Main Style Css-->
        <link href="{{ asset('public/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <!--Responsive Css-->
        <link href="{{ asset('public/assets/css/responsive.css')}}" rel="stylesheet" type="text/css"/>
        <!--Icons Css--> 
        <link href="{{ asset('public/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>

        <!--Animate Css--> 
        <link href="{{ asset('public/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>

        <script src="{{ asset('public/assets/js/modernizr.min.js')}}"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        
    </head>
    <body class="bg-grd-6">
        <div class="wrapper-page">
            <div class="panel">
                <div class="panel-body p-30">
                  <div class="rocks-logo">
                      <img src="{{ URL::to('public/assets/images/logo.png') }}">
                  </div>
                  <h3 class="text-center">Đăng Nhập Nhật Ký</h3>
                  <?php
    $message =  Session::get('message');
    if(isset($message)){
      echo'<div class="alert alert-danger alert-dismissible fade in">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          '.$message.'
                            </div>';
    Session::put('message', null);

    }
    ?>
                <form action="{{ URL::to('login') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                          <div class="position-relative has-icon-left">
                              <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập">
                           <div class="form-control-position">
                             <i class="icon-user"></i>
                           </div>
                        </div>
                     </div>

                     <div class="form-group mt-20">
                          <div class="position-relative has-icon-left">
                              <input type="password" class="form-control" name="password" placeholder="Mật Khẩu">
                           <div class="form-control-position">
                             <i class="icon-lock"></i>
                           </div>
                        </div>
                     </div> 
                    <div class="form-group mb-30">
                            <button class="btn btn-info btn-border btn-block w-lg waves-effect waves-light" type="submit">
                                <i class="icon-lock"></i> Đăng Nhập</button>
                    </div>
                </form> 
                </div>                                 
                
            </div>
        </div>

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- Main  Scripts-->
        <script src="{{ asset('public/assets/js/jquery.min.js')}}"></script> 
        <script src="{{ asset('public/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('public/assets/js/waves.js')}}"></script>
        <script src="{{ asset('public/assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{ asset('public/assets/js/app-script.js')}}"></script>
        <script>
          $('.sidebar-menu').SidebarNav();
          $(".do-nicescrol").niceScroll({
            cursorcolor:"rgba(137, 150, 162, 0.3)",
            cursorwidth:"6px",
            cursorborder:"0px solid rgba(45, 53, 60, 0.3)",
           });
        </script>
        <!-- placeholdem -->
        <script src="{{ asset('public/assets/js/placeholdem.min.js')}}"></script>
        <script type="text/javascript">
          Placeholdem( document.querySelectorAll( '[placeholder]' ) );
        </script>
	
	</body>
</html>