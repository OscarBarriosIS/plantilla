<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::with('roles')->get();
        return view('user.ver_users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('user.alta_user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'required|string',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => [
                'required',
                'string',
                Rule::in(['Admin', 'Empleado', 'Afiliado']), // Especifica los roles permitidos
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->input('role'));

        event(new Registered($user));

        return redirect(route('user.index', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.mostrar_users', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $user = User::findOrFail($id);
        return view('user.editar_users', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'apellido_paterno' => 'nullable|string|max:255',
                'apellido_materno' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'telefono' => 'nullable|string',
            ]);

            $user = User::findOrFail($id);
            $user->name = $validated['name'];
            $user->apellido_paterno = $validated['apellido_paterno'];
            $user->apellido_materno = $validated['apellido_materno'];
            $user->email = $validated['email'];
            $user->telefono = $validated['telefono'];
            $user->save();

            return redirect()->route('user.index')->with('success', 'Usuario actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Ocurrió un error al actualizar el usuario');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index');
    }
}
