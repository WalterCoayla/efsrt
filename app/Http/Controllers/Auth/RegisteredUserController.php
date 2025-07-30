<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\Estudiante; // ¡Importa el modelo Estudiante!
use App\Models\TipoDocumento;
use App\Models\ProgramaEstudio;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $tiposDocumento = TipoDocumento::all();
        $programasEstudio = ProgramaEstudio::all();

        return view('auth.register', compact('tiposDocumento', 'programasEstudio'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // Reglas de validación para la tabla Personas
            'nombres' => ['required', 'string', 'max:60'],
            'apellidos' => ['required', 'string', 'max:60'],
            'dni' => ['required', 'string', 'max:15', 'unique:personas,dni'],
            'correo_persona' => ['required', 'string', 'email', 'max:100', 'unique:personas,correo'],
            'direccion' => ['nullable', 'string', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:15'],
            'fecha_nacimiento' => ['nullable', 'date'],
            'id_tipo_documento' => ['required', 'integer', 'exists:tipos_documentos,id'],

            // Regla para el tipo de rol
            'role_type' => ['required', 'string', 'in:none,docente,estudiante'],

            // Reglas de validación condicionales para Docente
            'especialidad' => ['nullable', 'string', 'max:80', 'required_if:role_type,docente'],
            'id_programa_docente' => ['nullable', 'integer', 'exists:programas_estudios,id', 'required_if:role_type,docente'],

            // Reglas de validación condicionales para Estudiante
            'id_programa_estudiante' => ['nullable', 'integer', 'exists:programas_estudios,id', 'required_if:role_type,estudiante'],
        ]);

        // 1. Crear el registro en la tabla 'personas'
        $persona = Persona::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'correo' => $request->correo_persona,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'id_tipo_documento' => $request->id_tipo_documento,
        ]);

        // 2. Crear el registro en la tabla 'users' y vincularlo con la persona
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_persona' => $persona->id, // Vincular el usuario con la persona creada
        ]);

        // 3. Crear el registro en la tabla 'docentes' o 'estudiantes' si aplica
        if ($request->role_type === 'docente') {
            Docente::create([
                'id' => $persona->id, // El ID de docente es el mismo que el ID de persona
                'id_programa' => $request->id_programa_docente,
                'especialidad' => $request->especialidad,
            ]);
        } elseif ($request->role_type === 'estudiante') {
            Estudiante::create([
                'id' => $persona->id, // El ID de estudiante es el mismo que el ID de persona
                'id_programa' => $request->id_programa_estudiante,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
