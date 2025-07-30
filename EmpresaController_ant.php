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
     * Almacena una nueva empresa en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'razon_social' => 'required|string|max:100',
                'direccion' => 'nullable|string|max:150',
                'telefono' => 'nullable|string|max:15',
                'rubro' => 'nullable|string|max:200',
                'id_representante' => 'required|integer|exists:representantes,id', // Asegura que el representante exista
                'RUC' => 'nullable|string|max:11|unique:empresas,RUC', // RUC debe ser único
                'es_activa' => 'nullable|boolean',
            ]);

            // Crear la nueva empresa
            $empresa = Empresa::create($request->all());

            // Cargar las relaciones para la respuesta
            $empresa->load('representante.persona', 'representante.cargo');

            return response()->json($empresa, 201); // 201 Created
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear la empresa',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Muestra una empresa específica.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Empresa $empresa)
    {
        // Cargar las relaciones para la respuesta
        $empresa->load('representante.persona', 'representante.cargo');
        return response()->json($empresa);
    }

    /**
     * Actualiza una empresa existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Empresa $empresa)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'razon_social' => 'required|string|max:100',
                'direccion' => 'nullable|string|max:150',
                'telefono' => 'nullable|string|max:15',
                'rubro' => 'nullable|string|max:200',
                'id_representante' => 'required|integer|exists:representantes,id',
                'RUC' => 'nullable|string|max:11|unique:empresas,RUC,' . $empresa->id, // RUC debe ser único, excepto para la empresa actual
                'es_activa' => 'nullable|boolean',
            ]);

            // Actualizar la empresa
            $empresa->update($request->all());

            // Cargar las relaciones para la respuesta
            $empresa->load('representante.persona', 'representante.cargo');

            return response()->json($empresa);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la empresa',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Elimina una empresa de la base de datos.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Empresa $empresa)
    {
        try {
            $empresa->delete();
            return response()->json(['message' => 'Empresa eliminada exitosamente'], 204); // 204 No Content
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la empresa',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
