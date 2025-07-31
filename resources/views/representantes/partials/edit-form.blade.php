{{-- resources/views/representantes/partials/edit-form.blade.php --}}
<form id="editRepresentanteForm" method="POST" action="{{ route('representantes.update', $representante->id) }}">
    @csrf
    @method('PUT') {{-- Importante para las actualizaciones --}}

    <div class="form-group">
        <label for="id_persona">Persona:</label>
        {{-- En el formulario de edición, la persona asociada al representante no debería cambiarse fácilmente --}}
        {{-- Si 'id' en representantes es la PK y FK a personas.id, entonces este campo es solo para mostrar. --}}
        {{-- Si permites cambiarlo, implica que estás cambiando la PK, lo cual es complejo. --}}
        {{-- Para mantener la simplicidad, este select está deshabilitado y solo muestra la persona actual. --}}
        <select name="id_persona" id="id_persona" class="form-control" disabled>
            <option value="{{ $representante->persona->id ?? '' }}" selected>
                {{ $representante->persona->nombres ?? 'N/A' }} {{ $representante->persona->apellidos ?? '' }} (DNI: {{ $representante->persona->dni ?? 'N/A' }})
            </option>
        </select>
        {{-- Si necesitas enviar el ID de la persona para la validación, usa un campo oculto --}}
        <input type="hidden" name="id_persona" value="{{ $representante->id }}">
        @error('id_persona')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="id_cargo">Cargo:</label>
        <select name="id_cargo" id="id_cargo" class="form-control @error('id_cargo') is-invalid @enderror" required>
            <option value="">Seleccione un cargo</option>
            @foreach ($cargos as $cargo)
                <option value="{{ $cargo->id }}" {{ (old('id_cargo', $representante->id_cargo) == $cargo->id) ? 'selected' : '' }}>
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

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="es_firmante" name="es_firmante" value="1" {{ old('es_firmante', $representante->es_firmante) ? 'checked' : '' }}>
        <label class="form-check-label" for="es_firmante">Es Firmante</label>
        @error('es_firmante')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar Representante</button>
    </div>
</form>
