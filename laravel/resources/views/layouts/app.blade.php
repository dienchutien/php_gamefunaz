<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo  config('cmconst.text.title') ?></title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="<?php echo URL::to('/');?>/css/sb-admin-2.css" rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?php echo URL::to('/');?>/images/favicon.ico">
    <!-- Styles -->

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <div id="wrapper">
        <div class="form-control hidden" id="alert"><?php echo (session('status')?session('status'):'')?></div>
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand"><img class="logo" src="/images/logo-dxmb.png" alt="<?php echo  config('cmconst.text.title') ?>"></a>
                <!-- Branding Image -->
                
            </div>
            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a style="color:#337ab7" href="#">Marketing Tool</a></li>
                </ul>
                <!-- Modal -->
                
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (!Auth::guest())
                        <?php if(Auth::user()->hr_type == 1) { 
                            $o_LeaveRequest = new \App\Models\LeaveRequest();
                            $i_Count = $o_LeaveRequest->i_fCountLeaveRequestPending(); 
                        ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="header_color">Đơn chờ duyệt: <span class="hotline-support"><b><?php echo $i_Count?></b></span></span>
                            </a>
                        </li>
                        <?php } ?>
                        
                        
                        <li class="dropdown">
                            <a class="dropdown-toggle" role="button" href="javascript: GLOBAL_JS.v_fToggleLeftSide();">
                                <i class="fa fa-exchange"></i><span class="header_color"> Ẩn hiện menu trái</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" style="color:#337ab7" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
    
    
            @if (!Auth::guest())
            
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i>Bảng điều khiển</a>
                        </li>
                        <li class="">
                            <a href="#"><i class="fa fa-user"></i>Quản lý Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" aria-expanded="false">
                                <li class=""><a class="" href="<?php echo Request::root()."/user"?>">Danh sách Users</a></li>
                                <li><a class="" href="<?php echo Request::root()."/user/insert"?>">Thêm users mới</a></li>
                                <li><a class="" href="<?php echo Request::root()."/list-change-manager"?>">Danh sách thay đổi trưởng nhóm</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
            @endif
        </nav>
        @if (Auth::guest())
            <div id="page-wrapper" class="no-margin">
        @else
            <div id="page-wrapper">
        @endif
            @yield('content')
        </div>
    </div>
    </div>
    
    <!-- /#page-wrapper -->
    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="<?php echo URL::to('/');?>/js/metisMenu.min.js"></script>
    <script src="<?php echo URL::to('/');?>/js/sb-admin-2.js"></script>
    <script src="<?php echo URL::to('/');?>/js/global.js"></script>
    
    <!--Datepicker-->
    <script src="<?php echo URL::to('/');?>/plugins/datepicker/jquery-ui.min.js"></script>
    <script src="<?php echo URL::to('/');?>/plugins/datepicker/jquery-ui-timepicker-addon.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/');?>/plugins/datepicker/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('/');?>/plugins/datepicker/jquery-ui.theme.css">
</body>
</html>
