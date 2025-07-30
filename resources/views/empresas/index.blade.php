@extends('layouts.admin')

@section('title', 'Gestión de Empresas')
@section('page_title', 'Empresas')
@section('breadcrumb', 'Lista')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Empresas</h3>
            <div class="card-tools">
                <a href="{{ route('empresas.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle"></i> Agregar Empresa
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">RUC</th>
                            <th scope="col">Razón Social</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Email</th>
                            <th scope="col">Representante</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Se itera sobre la colección de empresas para mostrarlas en la tabla --}}
                        @forelse ($empresas as $empresa)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $empresa->ruc }}</td>
                                <td>{{ $empresa->razon_social }}</td>
                                <td>{{ $empresa->direccion }}</td>
                                <td>{{ $empresa->telefono }}</td>
                                <td>{{ $empresa->email }}</td>
                                <td>
                                    {{-- Muestra el nombre completo del representante si existe, de lo contrario 'N/A' --}}
                                    {{ $empresa->representante ? $empresa->representante->persona->nombres . ' ' . $empresa->representante->persona->apellidos : 'N/A' }}
                                    {{-- Muestra el cargo del representante si existe --}}
                                    @if($empresa->representante && $empresa->representante->cargo)
                                        ({{ $empresa->representante->cargo->nombre_cargo }})
                                    @endif
                                </td>
                                <td>
                                    {{-- Botón para editar la empresa --}}
                                    <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- Botón para abrir el modal de confirmación de eliminación --}}
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $empresa->id }}" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            {{-- Mensaje si no hay empresas registradas --}}
                            <tr>
                                <td colspan="8" class="text-center">No hay empresas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta empresa? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    {{-- Formulario para enviar la solicitud de eliminación --}}
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {{-- Script para cargar jQuery si no está disponible globalmente (aunque AdminLTE lo carga) --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- Script para pasar el ID de la empresa al modal de eliminación --}}
    <script>
        $(document).ready(function() {
            $('#confirmDeleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var empresaId = button.data('id'); // Extrae el ID de la empresa del atributo data-id
                var action = '/empresas/' + empresaId; // Ajusta esta ruta a tu ruta de eliminación real en Laravel
                $('#deleteForm').attr('action', action); // Establece la acción del formulario de eliminación
            });
        });
    </script>
@stop
