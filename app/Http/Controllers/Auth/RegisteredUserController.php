<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validamos los datos del formulario (RUT, Nombre, Clave)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Mantenemos tus validaciones de RUT intactas
            'rut' => ['required', 'string', 'lowercase', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Creamos el usuario MANUALMENTE
        // Usamos "new User" en vez de "User::create" para forzar el email automático
        // sin que el modelo nos bloquee.
        $user = new User();

        $user->name = $request->name;
        $user->rut = $request->rut;

        // --- AQUÍ ESTÁ LA SOLUCIÓN ---
        // Generamos un email automático e invisible para el usuario.
        // Esto satisface a la base de datos y evita el error 1364.
        $user->email = $request->rut . '@sin-email.cl';
        // -----------------------------

        $user->password = Hash::make($request->password);

        // 3. Guardamos en la Base de Datos
        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
