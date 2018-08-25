<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', "Feelsewglam")}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/png" href="{{asset('icon.png')}}">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}" >
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/Admin.css') }}">
    <!-- admin Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">
    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
    <script type="text/javascript" src="{{ asset("plugins/datatables/jquery.dataTables.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('table.datatable').DataTable();
        })
    </script>
    <style type="text/css">
        .info-box-number {
            font-size: 40px;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/admin" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>C</b>EO</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{--<img src="{{ asset("dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">Alexander Pierce</span>--}}
                            <img src="/storage/user_images/{{ Auth::user()->picture }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                {{--<img src="{{ asset("dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image">--}}

                                <img src="/storage/user_images/{{ Auth::user()->picture }}" class="img-circle" alt="User Image">

                                <p>
                                    {{--Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>--}}
                                    {{ Auth::user()->name }} - Admin
                                    <small>Member since {{ Auth::user()->created_at->toFormattedDateString()}}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                {{--<div class="pull-left">
                                    <a href="/admin/profile" class="btn btn-default btn-flat">Profile</a>
                                </div>--}}
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    {{--<img src="{{ asset("dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image">--}}

                    <img src="/storage/user_images/{{ Auth::user()->picture }}" class="user-image" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>
                        {{ Auth::user()->name }}
                    </p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{ (in_array($path, ['/'])) ? 'active': '' }}">
                    <a href="{{ route("/") }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard </span>
                    </a>
                </li>
                <li class="{{ (in_array($path, ['categories'])) ? 'active': '' }}">
                    <a href="{{ route("categories.index") }}">
                        <i class="fa fa-database"></i> <span>Categories </span>
                    </a>
                </li>
                <li class="{{ (in_array($path, ['clothing'])) ? 'active': '' }}">
                    <a href="{{ route("clothing.index") }}">
                        <i class="fa fa-file-image-o"></i> <span>Clothing</span>
                    </a>
                </li>
                <li class="{{ (in_array($path, ['users'])) ? 'active': '' }}">
                    <a href="{{ route("users.index") }}">
                        <i class="fa fa-users"></i> <span>Users </span>
                    </a>
                </li>
                <li class="{{ (in_array($path, ['register'])) ? 'active': '' }}">
                    <a href="{{ route("register") }}">
                        <i class="fa fa-user"></i> <span>Register</span>
                        <span class="pull-right-container">
                              <small class="label pull-right bg-green">new</small>
                            </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off"></i> <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $title }}
                <small>Control panel</small>
            </h1>
            @include('layouts.messages')
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
                <li class="active">{{ $title  }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                @yield('content')
            </div>
            <!-- /.row (main row) -->
        </section>
        <!-- /.content -->
    </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> {{ config('app.version') }}
        </div>
        <strong>Copyright &copy; {{ date('Y') }} <a href="http://valenceweb.com">{{ config('app.developer') }}</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="hidden"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebars background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- admin App -->
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<!-- admin dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- admin for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

</body>
</html>
