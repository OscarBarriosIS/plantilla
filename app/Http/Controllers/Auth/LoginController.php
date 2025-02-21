<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('dashboard')); 
        }

        return redirect()->back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput($request->only('email')); 
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    public function showForm()
    {
        return view('register');
    }


    public function showForm2()
    {
        $roles = Role::all();
        return view('user.registro_users', compact('roles'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
            'imagen' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // dd($request->imagen);
        $imagePath = null;
        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('images', 'public');
        }

        $role = Role::where('name', 'Admin')->first();

        $user = User::create([
            'name' => $validated['name'],
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => bcrypt($validated['password']),
            'role_id' => $role->id,
            'imagen' => $imagePath,
        ]);

        $user->assignRole('Admin');

        return redirect()->route('login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }



    public function register2(Request $request)
    {
       /*  $request->validate([
            'name' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'sexo' => 'required|string',
            'estado_civil' => 'required|string',
            'nacionalidad' => 'required|string',
            'rfc' => 'required|string|max:13',
            'curp' => 'required|string|max:18',
            'telefono' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
            'fecha_nacimiento' => 'required|date',
            'role_id' => 'required|exists:roles,id',
        ]); */

        User::create([
            'name' => $request->name,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'sexo' => $request->sexo,
            'estado_civil' => $request->estado_civil,
            'nacionalidad' => $request->nacionalidad,
            'rfc' => $request->rfc,
            'curp' => $request->curp,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'role_id' => $request->role_id,
        ]);

        return redirect()->back()->with('status', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }
}
