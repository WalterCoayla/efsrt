<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard EFSRT')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <!-- Custom CSS (optional) -->
    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contacto</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Buscar">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                {{-- Enlace de Cerrar Sesión (visible para usuarios autenticados) --}}
                @auth
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">EFSRT IESJCM</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        {{-- Icono de usuario de Font Awesome en blanco --}}
                        <!-- <i class="fa-regular fa-user fa-2x text-white" style="line-height: 2.5;"></i> -->
                        <i class="far fa-user text-white" style="line-height: 2.5;"></i>
                    </div>
                    <div class="info">
                        {{-- Muestra el nombre del usuario autenticado desde la relación con Persona --}}
                        @auth
                            @if(Auth::user()->persona)
                                <a href="#" class="d-block">{{ Auth::user()->persona->nombres }} {{ Auth::user()->persona->apellidos }}</a>
                            @else
                                <a href="#" class="d-block">{{ Auth::user()->name }} (Persona no asignada)</a>
                            @endif
                        @else
                            <a href="#" class="d-block">Invitado</a>
                        @endauth
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Buscar">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Dashboard siempre visible -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link @if(Request::routeIs('dashboard')) active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        {{-- Opciones para Administradores --}}
                        @auth
                            @if(Auth::user()->role_type === 'admin')
                                <li class="nav-item">
                                    <a href="{{ route('empresas.index') }}" class="nav-link @if(Request::routeIs('empresas.*')) active @endif">
                                        <i class="nav-icon fas fa-building"></i>
                                        <p>
                                            Empresas
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('representantes.index') }}" class="nav-link @if(Request::routeIs('representantes.*')) active @endif">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                            Representantes
                                        </p>
                                    </a>
                                </li>
                            @endif

                            {{-- Opciones para Docentes --}}
                            @if(Auth::user()->role_type === 'docente')
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> {{-- Reemplazar # con la ruta de perfil de docente --}}
                                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                        <p>
                                            Mi Perfil Docente
                                        </p>
                                    </a>
                                </li>
                                {{-- Agrega más opciones específicas para docentes aquí --}}
                            @endif

                            {{-- Opciones para Estudiantes --}}
                            @if(Auth::user()->role_type === 'estudiante')
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> {{-- Reemplazar # con la ruta de perfil de estudiante --}}
                                        <i class="nav-icon fas fa-user-graduate"></i>
                                        <p>
                                            Mi Perfil Estudiante
                                        </p>
                                    </a>
                                </li>
                                {{-- Agrega más opciones específicas para estudiantes aquí --}}
                            @endif
                        @endauth
                        {{-- Puedes agregar más elementos de menú aquí --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page_title', 'Página')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">@yield('breadcrumb', 'Página Actual')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Título</h5>
                <p>Contenido del Sidebar de Control</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Todo lo que quieras
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023-2024 <a href="#">EFSRT</a>.</strong> Todos los derechos reservados.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- Custom JS (optional) -->
    @yield('js')
</body>
</html>
