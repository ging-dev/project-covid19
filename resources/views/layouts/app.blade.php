<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>COVID-19 @yield('title')</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        @livewireStyles
    </head>
    <body class="hold-transition layout-top-nav light-mode">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand-md navbar-light">
                <div class="container">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        nCov-19 Project
                    </a>
                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                        <!-- Left navbar links -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                                Dropdown
                                </a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    <li><a href="#" class="dropdown-item">Some other action</a></li>
                                    <li class="dropdown-divider"></li>
                                    <!-- Level two dropdown-->
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                            <li>
                                                <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                            </li>
                                            <!-- Level three dropdown-->
                                            <li class="dropdown-submenu">
                                                <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                                                <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                                </ul>
                                            </li>
                                            <!-- End Level three -->
                                            <li><a href="#" class="dropdown-item">level 2</a></li>
                                            <li><a href="#" class="dropdown-item">level 2</a></li>
                                        </ul>
                                    </li>
                                    <!-- End Level two -->
                                </ul>
                            </li>
                        </ul>
                        <!-- SEARCH FORM -->
                        <form class="form-inline ml-0 ml-md-3">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Right navbar links -->
                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <!-- User -->
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <div class="dropdown-item">
                                    <div class="media">
                                        <img src="{{ Auth::user()->photo }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                {{ Auth::user()->full_name }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('auth.logout') }}" class="dropdown-item dropdown-footer">
                                <i class="fa fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('auth.login') }}" class="nav-link">
                            <i class="fa fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </nav>
            <!-- /.navbar -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Dashboard</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    @yield('breadcrumb')
                                </ol>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <!-- Main content -->
                <div class="content">
                    <div class="container">
                        <!-- <div n:foreach="$flashes as $flash" class="callout callout-{$flash->type}">{$flash->message}</div> -->
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    <i class="fas fa-user-secret"></i> GingTeam
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; {{ date('Y') }} Trần Xuân Thanh.</strong> All rights reserved.
            </footer>
        </div>
        <!-- ./wrapper -->
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
        @livewireScripts
    </body>
</html>
