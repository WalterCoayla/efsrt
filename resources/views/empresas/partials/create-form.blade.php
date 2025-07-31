<form id="createEmpresaForm" action="{{ route('empresas.store') }}" method="POST">
    @csrf
    {{-- Manejo de errores de validación si el formulario se envía con POST tradicional --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label for="razon_social" class="form-label">Razón Social:</label>
        <input type="text" id="razon_social" name="razon_social" class="form-control @error('razon_social') is-invalid @enderror" value="{{ old('razon_social') }}" required>
        @error('razon_social')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="RUC" class="form-label">RUC:</label>
        <input type="text" id="RUC" name="RUC" class="form-control @error('RUC') is-invalid @enderror" value="{{ old('RUC') }}">
        @error('RUC')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="direccion" class="form-label">Dirección:</label>
        <input type="text" id="direccion" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}">
        @error('direccion')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
        @error('telefono')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="rubro" class="form-label">Rubro:</label>
        <input type="text" id="rubro" name="rubro" class="form-control @error('rubro') is-invalid @enderror" value="{{ old('rubro') }}">
        @error('rubro')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="id_representante" class="form-label">Representante:</label>
        <select id="id_representante" name="id_representante" class="form-control @error('id_representante') is-invalid @enderror" required>
            <option value="">Seleccione un representante</option>
            @foreach($representantes as $rep)
                <option value="{{ $rep->id }}" {{ old('id_representante') == $rep->id ? 'selected' : '' }}>
                    {{ $rep->persona->nombres ?? '' }} {{ $rep->persona->apellidos ?? '' }} ({{ $rep->cargo->nombre ?? $rep->cargo }})
                </option>
            @endforeach
        </select>
        @error('id_representante')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" id="es_activa" name="es_activa" value="1" class="form-check-input" {{ old('es_activa') ? 'checked' : '' }}>
        <label for="es_activa" class="form-check-label">Es Activa</label>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar Empresa</button>
    </div>
</form>
