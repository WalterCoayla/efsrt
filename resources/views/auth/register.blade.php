<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Registro de Nuevo Usuario</h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Sección de Datos de Usuario (Breeze por defecto) -->
                            <h5 class="mb-3 text-primary">Datos de Acceso</h5>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre de Usuario</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email (para login)</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <hr class="my-4">

                            <!-- Sección de Datos de Persona -->
                            <h5 class="mb-3 text-primary">Datos Personales</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombres" class="form-label">Nombres</label>
                                    <input id="nombres" type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres" value="{{ old('nombres') }}" required autocomplete="given-name">
                                    @error('nombres')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="family-name">
                                    @error('apellidos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dni" class="form-label">DNI</label>
                                    <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required>
                                    @error('dni')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="correo_persona" class="form-label">Email Personal</label>
                                    <input id="correo_persona" type="email" class="form-control @error('correo_persona') is-invalid @enderror" name="correo_persona" value="{{ old('correo_persona') }}" required autocomplete="email">
                                    @error('correo_persona')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" autocomplete="street-address">
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" autocomplete="tel">
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                    <input id="fecha_nacimiento" type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                                    @error('fecha_nacimiento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="id_tipo_documento" class="form-label">Tipo de Documento</label>
                                <select id="id_tipo_documento" class="form-select @error('id_tipo_documento') is-invalid @enderror" name="id_tipo_documento" required>
                                    <option value="">Seleccione un tipo de documento</option>
                                    @foreach($tiposDocumento as $tipo)
                                        <option value="{{ $tipo->id }}" @selected(old('id_tipo_documento') == $tipo->id)>{{ $tipo->tipo }}</option>
                                    @endforeach
                                </select>
                                @error('id_tipo_documento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <!-- Sección de Selección de Rol -->
                            <h5 class="mb-3 text-primary">Tipo de Rol</h5>
                            <div class="mb-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role_type" id="role_none" value="none" {{ old('role_type', 'none') == 'none' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_none">Ninguno</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role_type" id="role_docente" value="docente" {{ old('role_type') == 'docente' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_docente">Docente</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role_type" id="role_estudiante" value="estudiante" {{ old('role_type') == 'estudiante' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_estudiante">Estudiante</label>
                                </div>
                                @error('role_type')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sección de Datos de Docente (Condicional) -->
                            <div id="docente_fields" style="{{ old('role_type') == 'docente' ? '' : 'display:none;' }}">
                                <h5 class="mb-3 text-primary">Datos de Docente</h5>
                                <div class="mb-3">
                                    <label for="id_programa_docente" class="form-label">Programa de Estudio (Docente)</label>
                                    <select id="id_programa_docente" class="form-select @error('id_programa_docente') is-invalid @enderror" name="id_programa_docente">
                                        <option value="">Seleccione un programa</option>
                                        @foreach($programasEstudio as $programa)
                                            <option value="{{ $programa->id }}" @selected(old('id_programa_docente') == $programa->id)>{{ $programa->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_programa_docente')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="especialidad" class="form-label">Especialidad (Docente)</label>
                                    <input id="especialidad" type="text" class="form-control @error('especialidad') is-invalid @enderror" name="especialidad" value="{{ old('especialidad') }}">
                                    @error('especialidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Sección de Datos de Estudiante (Condicional) -->
                            <div id="estudiante_fields" style="{{ old('role_type') == 'estudiante' ? '' : 'display:none;' }}">
                                <h5 class="mb-3 text-primary">Datos de Estudiante</h5>
                                <div class="mb-4">
                                    <label for="id_programa_estudiante" class="form-label">Programa de Estudio (Estudiante)</label>
                                    <select id="id_programa_estudiante" class="form-select @error('id_programa_estudiante') is-invalid @enderror" name="id_programa_estudiante">
                                        <option value="">Seleccione un programa</option>
                                        @foreach($programasEstudio as $programa)
                                            <option value="{{ $programa->id }}" @selected(old('id_programa_estudiante') == $programa->id)>{{ $programa->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_programa_estudiante')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-4">
                                <a class="text-muted text-decoration-none me-3" href="{{ route('login') }}">
                                    ¿Ya estás registrado?
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleRadios = document.querySelectorAll('input[name="role_type"]');
            const docenteFields = document.getElementById('docente_fields');
            const estudianteFields = document.getElementById('estudiante_fields');

            function toggleRoleFields() {
                const selectedRole = document.querySelector('input[name="role_type"]:checked').value;

                // Ocultar todos los campos y limpiar sus valores
                docenteFields.style.display = 'none';
                estudianteFields.style.display = 'none';
                clearFormFields(docenteFields);
                clearFormFields(estudianteFields);

                // Mostrar los campos del rol seleccionado
                if (selectedRole === 'docente') {
                    docenteFields.style.display = 'block';
                } else if (selectedRole === 'estudiante') {
                    estudianteFields.style.display = 'block';
                }
            }

            // Función para limpiar los campos de un contenedor
            function clearFormFields(container) {
                container.querySelectorAll('input, select, textarea').forEach(field => {
                    if (field.type === 'checkbox' || field.type === 'radio') {
                        field.checked = false;
                    } else if (field.tagName === 'SELECT') {
                        field.selectedIndex = 0; // Seleccionar la primera opción (generalmente "Seleccione...")
                    } else {
                        field.value = '';
                    }
                });
            }

            // Añadir event listeners a los radio buttons
            roleRadios.forEach(radio => {
                radio.addEventListener('change', toggleRoleFields);
            });

            // Ejecutar al cargar la página para mostrar el estado inicial (útil para old() values)
            toggleRoleFields();
        });
    </script>
    @endpush
</x-guest-layout>
