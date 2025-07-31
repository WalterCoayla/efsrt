@extends('layouts.admin')

@section('title', 'Gestión de Representantes')
@section('page_title', 'Representantes')
@section('breadcrumb', 'Lista')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Representantes</h3>
            <div class="card-tools">
                <!-- Botón para abrir el modal de creación de representante -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createRepresentanteModal">
                    <i class="fas fa-plus-circle"></i> Agregar Representante
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
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Email Personal</th>
                            <th scope="col">Cargo</th>
                            <th scope="col">Es Firmante</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($representantes as $representante)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $representante->persona->nombres ?? 'N/A' }}</td>
                                <td>{{ $representante->persona->apellidos ?? 'N/A' }}</td>
                                <td>{{ $representante->persona->dni ?? 'N/A' }}</td>
                                <td>{{ $representante->persona->correo ?? 'N/A' }}</td>
                                <td>
                                    {{ $representante->cargo->nombre ?? 'N/A' }}
                                </td>
                                <td>
                                    <span class="badge {{ $representante->es_firmante ? 'badge-success' : 'badge-danger' }}">
                                        {{ $representante->es_firmante ? 'Sí' : 'No' }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Botón para abrir el modal de edición de representante -->
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editRepresentanteModal" data-id="{{ $representante->id }}" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $representante->id }}" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No hay representantes registrados.</td>
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
                    ¿Estás seguro de que deseas eliminar este representante? Esta acción no se puede deshacer.
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

    <!-- Modal para Crear Representante -->
    <div class="modal fade" id="createRepresentanteModal" tabindex="-1" role="dialog" aria-labelledby="createRepresentanteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRepresentanteModalLabel">Crear Nuevo Representante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="createRepresentanteModalBody">
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

    <!-- Modal para Editar Representante -->
    <div class="modal fade" id="editRepresentanteModal" tabindex="-1" role="dialog" aria-labelledby="editRepresentanteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRepresentanteModalLabel">Editar Representante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editRepresentanteModalBody">
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
            // Script para pasar el ID del representante al modal de eliminación
            $('#confirmDeleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var representanteId = button.data('id'); // Extrae el ID del representante del atributo data-id
                var action = '/representantes/' + representanteId; // Construye la URL de la acción del formulario
                $('#deleteForm').attr('action', action); // Establece la acción del formulario de eliminación
            });

            // Script para cargar el formulario de creación en el modal
            $('#createRepresentanteModal').on('show.bs.modal', function (event) {
                var modalBody = $(this).find('#createRepresentanteModalBody');
                modalBody.html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Cargando...</span></div><p class="mt-2">Cargando formulario...</p></div>');

                $.get("{{ route('representantes.create') }}", function(data) {
                    modalBody.html(data);
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    let errorMessage = 'Error al cargar el formulario de creación. Por favor, inténtalo de nuevo.';
                    if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                        errorMessage = jqXHR.responseJSON.message;
                    } else if (errorThrown) {
                        errorMessage = `Error: ${errorThrown}`;
                    }
                    modalBody.html('<div class="alert alert-danger"><strong>¡Error!</strong> ' + errorMessage + '</div>');
                    console.error("Error al cargar el formulario de creación en el modal:", textStatus, errorThrown, jqXHR);
                });
            });

            // Script para cargar el formulario de edición en el modal
            $('#editRepresentanteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var representanteId = button.data('id'); // Extrae el ID del representante
                var modalBody = $(this).find('#editRepresentanteModalBody');
                modalBody.html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Cargando...</span></div><p class="mt-2">Cargando formulario...</p></div>');

                $.get("/representantes/" + representanteId + "/edit", function(data) {
                    modalBody.html(data);
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    let errorMessage = 'Error al cargar el formulario de edición. Por favor, inténtalo de nuevo.';
                    if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                        errorMessage = jqXHR.responseJSON.message;
                    } else if (errorThrown) {
                        errorMessage = `Error: ${errorThrown}`;
                    }
                    modalBody.html('<div class="alert alert-danger"><strong>¡Error!</strong> ' + errorMessage + '</div>');
                    console.error("Error al cargar el formulario de edición en el modal:", textStatus, errorThrown, jqXHR);
                });
            });

            // Si el formulario dentro de los modales se envía y hay errores de validación o un mensaje de error,
            // Laravel redirigirá de vuelta a la página de índice con los errores en la sesión.
            // Este script detecta esos errores o mensajes de sesión y vuelve a mostrar el modal correspondiente.
            @if ($errors->any() || session('error'))
                // Determinar qué modal abrir si hay errores (esto es una suposición, podrías necesitar más lógica)
                // Por ejemplo, si los errores son de 'id_persona' o 'id_cargo', es probable que sea el modal de creación/edición
                // Aquí, por simplicidad, asumimos que si hay errores, es del último formulario intentado.
                // Para una lógica más robusta, podrías pasar un indicador desde el controlador.
                setTimeout(function() {
                    // Si hay errores, intentar reabrir el modal de creación o edición.
                    // Esto es una heurística; para ser preciso, necesitarías saber qué formulario causó el error.
                    // Por ahora, si hay errores, intentamos reabrir el modal de creación.
                    // Si el error es de edición, el usuario tendría que reabrirlo manualmente.
                    $('#createRepresentanteModal').modal('show');
                    // O si tienes una forma de saber si el error fue de edición:
                    // $('#editRepresentanteModal').modal('show');
                }, 200);
            @endif
        });
    </script>
@stop
