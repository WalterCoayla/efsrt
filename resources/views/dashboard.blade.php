@extends('layouts.admin') {{-- Extiende tu plantilla principal de AdminLTE --}}

@section('title', 'Dashboard') {{-- Título de la página --}}
@section('page_title', 'Dashboard Principal') {{-- Título en el encabezado de contenido --}}
@section('breadcrumb', 'Inicio') {{-- Breadcrumb --}}

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">¡Bienvenido al Dashboard!</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Has iniciado sesión exitosamente en tu aplicación EFSRT con AdminLTE.
                        </p>
                        <p class="card-text">
                            Puedes navegar usando el menú lateral.
                        </p>
                    </div>
                </div>
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@stop

{{-- Puedes añadir scripts específicos para el dashboard aquí si los necesitas --}}
@section('js')
    {{-- <script> console.log('Hi, I am using the Dashboard!'); </script> --}}
@stop
