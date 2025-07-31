@extends('layouts.admin')

@section('title', 'Gestión de Empresas')
@section('page_title', 'Empresas')
@section('breadcrumb', 'Lista')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Empresas</h3>
            <div class="card-tools">
                <!-- Botón para abrir el modal de creación de empresa -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createEmpresaModal">
                    <i class="fas fa-plus-circle"></i> Agregar Empresa
                </button>
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
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- Muestra errores de validación si existen (ej. después de un envío fallido del modal) --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
                            <th scope="col">Activa</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($empresas as $empresa)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $empresa->RUC }}</td>
                                <td>{{ $empresa->razon_social }}</td>
                                <td>{{ $empresa->direccion }}</td>
                                <td>{{ $empresa->telefono }}</td>
                                {{-- Muestra el correo de la persona asociada al representante --}}
                                <td>{{ $empresa->representante->persona->correo ?? 'N/A' }}</td>
                                <td>
                                    {{-- Muestra el nombre completo del representante si existe --}}
                                    {{ $empresa->representante ? ($empresa->representante->persona->nombres ?? '') . ' ' . ($empresa->representante->persona->apellidos ?? '') : 'N/A' }}
                                    {{-- Muestra el nombre del cargo del representante desde la tabla 'cargos' --}}
                                    @if($empresa->representante && $empresa->representante->cargo)
                                        ({{ $empresa->representante->cargo->nombre ?? 'Cargo no especificado' }})
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $empresa->es_activa ? 'badge-success' : 'badge-danger' }}">
                                        {{ $empresa->es_activa ? 'Sí' : 'No' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $empresa->id }}" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No hay empresas registradas.</td>
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
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Crear Empresa -->
    <div class="modal fade" id="createEmpresaModal" tabindex="-1" role="dialog" aria-labelledby="createEmpresaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEmpresaModalLabel">Crear Nueva Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="createEmpresaModalBody">
                    <!-- El formulario se cargará aquí vía AJAX -->
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Cargando...</span>
                        </div>
                        <p class="mt-2">Cargando formulario...</p>
                    </div>
                </div>
                {{-- El modal-footer se incluye en el partial del formulario --}}
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Script para pasar el ID de la empresa al modal de eliminación
            $('#confirmDeleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var empresaId = button.data('id'); // Extrae info de los atributos data-*
                var action = '/empresas/' + empresaId; // Ajusta esta ruta a tu ruta de eliminación real
                $('#deleteForm').attr('action', action);
            });

            // Script para cargar el formulario de creación en el modal
            $('#createEmpresaModal').on('show.bs.modal', function (event) {
                var modalBody = $(this).find('#createEmpresaModalBody');
                // Muestra un spinner mientras carga
                modalBody.html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Cargando...</span></div><p class="mt-2">Cargando formulario...</p></div>');

                // Realiza la petición AJAX para obtener el formulario
                $.get("{{ route('empresas.create') }}", function(data) {
                    modalBody.html(data); // Inserta el contenido del formulario en el modal
                    // Si el formulario cargado contiene scripts o necesita reinicialización de plugins, hazlo aquí.
                }).fail(function() {
                    modalBody.html('<div class="alert alert-danger">Error al cargar el formulario. Por favor, inténtalo de nuevo.</div>');
                });
            });

            // Si el formulario dentro del modal se envía y hay errores de validación o un mensaje de error,
            // Laravel redirigirá de vuelta a la página de índice con los errores en la sesión.
            // Este script detecta esos errores o mensajes de sesión y vuelve a mostrar el modal.
            @if ($errors->any() || session('error'))
                $('#createEmpresaModal').modal('show');
            @endif
        });
    </script>
@stop
