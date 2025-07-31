{{-- resources/views/representantes/partials/create-form.blade.php --}}
<form id="createRepresentanteForm" method="POST" action="{{ route('representantes.store') }}">
    @csrf

    <!-- Tipo de Creación: Seleccionar existente o Crear nueva persona -->
    <div class="form-group">
        <label>Tipo de Creación:</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="creation_type" id="creation_existing" value="existing" {{ old('creation_type', 'existing') == 'existing' ? 'checked' : '' }}>
            <label class="form-check-label" for="creation_existing">Seleccionar Persona Existente</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="creation_type" id="creation_new" value="new" {{ old('creation_type') == 'new' ? 'checked' : '' }}>
            <label class="form-check-label" for="creation_new">Crear Nueva Persona</label>
        </div>
        @error('creation_type')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- Sección para seleccionar Persona Existente (condicional) -->
    <div id="existing_persona_fields" style="{{ old('creation_type', 'existing') == 'existing' ? '' : 'display:none;' }}">
        <div class="form-group">
            <label for="id_persona_existente">Persona Existente:</label>
            <select name="id_persona_existente" id="id_persona_existente" class="form-control @error('id_persona_existente') is-invalid @enderror">
                <option value="">Seleccione una persona</option>
                @foreach ($personas as $persona)
                    <option value="{{ $persona->id }}" {{ old('id_persona_existente') == $persona->id ? 'selected' : '' }}>
                        {{ $persona->nombres }} {{ $persona->apellidos }} (DNI: {{ $persona->dni }})
                    </option>
                @endforeach
            </select>
            @error('id_persona_existente')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Sección para crear Nueva Persona (condicional) -->
    <div id="new_persona_fields" style="{{ old('creation_type') == 'new' ? '' : 'display:none;' }}">
        <h5 class="mt-4 mb-3 text-primary">Datos de Nueva Persona</h5>
        <div class="row"> {{-- Inicia la fila para 2 columnas --}}
            <div class="form-group col-md-6"> {{-- Columna 1 --}}
                <label for="nombres">Nombres:</label>
                <input type="text" name="nombres" id="nombres" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres') }}">
                @error('nombres')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-6"> {{-- Columna 2 --}}
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos') }}">
                @error('apellidos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> {{-- Termina la fila --}}

        <div class="row"> {{-- Nueva fila para 2 columnas --}}
            <div class="form-group col-md-6"> {{-- Columna 1 --}}
                <label for="dni">DNI:</label>
                <input type="text" name="dni" id="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni') }}">
                @error('dni')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-6"> {{-- Columna 2 --}}
                <label for="correo_persona">Email Personal:</label>
                <input type="email" name="correo_persona" id="correo_persona" class="form-control @error('correo_persona') is-invalid @enderror" value="{{ old('correo_persona') }}">
                @error('correo_persona')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> {{-- Termina la fila --}}

        <div class="form-group"> {{-- Fila completa para Dirección --}}
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}">
            @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row"> {{-- Nueva fila para 2 columnas --}}
            <div class="form-group col-md-6"> {{-- Columna 1 --}}
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                @error('telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-6"> {{-- Columna 2 --}}
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}">
                @error('fecha_nacimiento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> {{-- Termina la fila --}}

        <div class="form-group"> {{-- Fila completa para Tipo de Documento --}}
            <label for="id_tipo_documento">Tipo de Documento:</label>
            <select name="id_tipo_documento" id="id_tipo_documento" class="form-control @error('id_tipo_documento') is-invalid @enderror">
                <option value="">Seleccione un tipo de documento</option>
                @foreach ($tiposDocumento as $tipo)
                    <option value="{{ $tipo->id }}" {{ old('id_tipo_documento') == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->tipo }}
                    </option>
                @endforeach
            </select>
            @error('id_tipo_documento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Campos de Cargo y Es Firmante (comunes a ambos tipos de creación) -->
    <h5 class="mt-4 mb-3 text-primary">Datos del Representante</h5>
    <div class="row"> {{-- Inicia la fila para 2 columnas --}}
        <div class="form-group col-md-6"> {{-- Columna 1 --}}
            <label for="id_cargo">Cargo:</label>
            <select name="id_cargo" id="id_cargo" class="form-control @error('id_cargo') is-invalid @enderror" required>
                <option value="">Seleccione un cargo</option>
                @foreach ($cargos as $cargo)
                    <option value="{{ $cargo->id }}" {{ old('id_cargo') == $cargo->id ? 'selected' : '' }}>
                        {{ $cargo->nombre }}
                    </option>
                @endforeach
            </select>
            @error('id_cargo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6"> {{-- Columna 2 --}}
            <div class="form-check mt-4"> {{-- Ajuste de margen para alinear con el select --}}
                <input type="checkbox" class="form-check-input" id="es_firmante" name="es_firmante" value="1" {{ old('es_firmante') ? 'checked' : '' }}>
                <label class="form-check-label" for="es_firmante">Es Firmante</label>
                @error('es_firmante')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div> {{-- Termina la fila --}}

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Representante</button>
    </div>
</form>

<script>
    // console.log('Script de create-form.blade.php cargado.'); // DEBUG: Confirmar que el script se carga

    const creationTypeRadios = document.querySelectorAll('input[name="creation_type"]');
    const existingPersonaFields = document.getElementById('existing_persona_fields');
    const newPersonaFields = document.getElementById('new_persona_fields');

    // Función para alternar la visibilidad de los campos de persona
    function togglePersonaFields() {
        const selectedType = document.querySelector('input[name="creation_type"]:checked').value;
        // console.log('Tipo de creación seleccionado en togglePersonaFields:', selectedType); // DEBUG: Para ver qué tipo se selecciona

        if (selectedType === 'existing') {
            existingPersonaFields.style.display = 'block';
            newPersonaFields.style.display = 'none';
            // Limpiar campos de nueva persona cuando se ocultan
            clearFormFields(newPersonaFields);
        } else { // 'new'
            existingPersonaFields.style.display = 'none';
            newPersonaFields.style.display = 'block'; // Esta línea hace visible los campos de nueva persona
            // Limpiar select de persona existente cuando se oculta
            clearFormFields(existingPersonaFields);
        }
    }

    // Función para limpiar los campos de un contenedor
    function clearFormFields(container) {
        container.querySelectorAll('input, select, textarea').forEach(field => {
            if (field.type === 'checkbox' || field.type === 'radio') {
                field.checked = false;
            } else if (field.tagName === 'SELECT') {
                field.selectedIndex = 0; // Seleccionar la primera opción
            } else {
                field.value = '';
            }
            // Eliminar clases de validación para evitar que se muestren errores antiguos
            field.classList.remove('is-invalid');
            const feedback = field.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.style.display = 'none';
            }
        });
    }

    // Añadir event listeners a los radio buttons para que la función se ejecute al cambiar la selección
    creationTypeRadios.forEach(radio => {
        radio.addEventListener('change', togglePersonaFields);
    });

    // Ejecutar la función inmediatamente después de que el script se cargue
    // Esto es crucial para que los campos correctos se muestren si hay valores 'old' del servidor
    togglePersonaFields();

    // Si hay errores de validación después de un envío, reabrir el modal y el tipo de creación correcto
    // Esto se maneja en el script principal de index.blade.php, pero aquí aseguramos la visibilidad
    @if ($errors->any())
        const hasNewPersonaErrors = document.querySelectorAll('#new_persona_fields .is-invalid').length > 0;
        const hasExistingPersonaErrors = document.querySelectorAll('#existing_persona_fields .is-invalid').length > 0;

        if (hasNewPersonaErrors) {
            document.getElementById('creation_new').checked = true;
        } else if (hasExistingPersonaErrors) {
            document.getElementById('creation_existing').checked = true;
        }
        togglePersonaFields(); // Asegura que la sección correcta esté visible
    @endif
</script>
