<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmpresaController extends Controller
{
    /**
     * Muestra una lista de todas las empresas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Obtener todas las empresas con su representante asociado
        // Usamos with('representante') para cargar la relación y evitar el problema N+1
        $empresas = Empresa::with('representante.persona', 'representante.cargo')->get();
        // return response()->json($empresas);
        return view('empresas.index', compact('empresas'));
    }

    /**
     * Muestra el formulario para crear una nueva empresa.
     */
    public function create()
    {
        // Puedes pasar datos adicionales a la vista si son necesarios para el formulario,
        // por ejemplo, una lista de representantes o cargos si los manejas en un select.
        return view('empresas.create');
    }

    /**
     * Almacena una nueva empresa en la base de datos.
     */
    public function store(Request $request)
    {
        // Aquí iría la lógica para validar y guardar los datos de la nueva empresa.
        // Ejemplo básico de validación y guardado:
        $request->validate([
            'ruc' => 'required|string|max:11|unique:empresas,ruc',
            'razon_social' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:empresas,email',
            // Agrega aquí las validaciones para representante_id si es necesario
        ]);

        $empresa = Empresa::create($request->all());

        return redirect()->route('empresas.index')->with('success', 'Empresa creada exitosamente.');
    }

    /**
     * Muestra los detalles de una empresa específica.
     */
    public function show(Empresa $empresa)
    {
        // Este método se usaría para mostrar una empresa individualmente, si tuvieras una vista 'show'.
        // Por ahora, no es estrictamente necesario para el index y create/store.
        return view('empresas.show', compact('empresa'));
    }

    /**
     * Muestra el formulario para editar una empresa existente.
     */
    public function edit(Empresa $empresa)
    {
        // Aquí pasarías la empresa a la vista de edición.
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Actualiza una empresa existente en la base de datos.
     */
    public function update(Request $request, Empresa $empresa)
    {
        // Lógica para validar y actualizar la empresa.
        $request->validate([
            'ruc' => 'required|string|max:11|unique:empresas,ruc,' . $empresa->id,
            'razon_social' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:empresas,email,' . $empresa->id,
        ]);

        $empresa->update($request->all());

        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada exitosamente.');
    }

    /**
     * Elimina una empresa de la base de datos.
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        return redirect()->route('empresas.index')->with('success', 'Empresa eliminada exitosamente.');
    }
    
}
