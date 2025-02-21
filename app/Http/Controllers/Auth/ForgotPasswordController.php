<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function recover(Request $request)
    {
        // Validar el email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['email' => 'Este correo electrónico no está registrado.']);
        }

        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        // Generar una nueva contraseña aleatoria
        $newPassword = Str::random(12); // Genera una cadena aleatoria de 12 caracteres

        // Hashear la nueva contraseña antes de guardarla
        $hashedPassword = Hash::make($newPassword);

        // Actualizar la contraseña del usuario en la base de datos
        $user->password = $hashedPassword;
        $user->save();

        // Enviar la nueva contraseña al usuario por correo electrónico
        $this->sendNewPasswordEmail($user, $newPassword);

        return back()->with('status', 'Se ha enviado una nueva contraseña a tu correo electrónico.');
    }

    protected function sendNewPasswordEmail($user, $newPassword)
    {
        $data = [
            'name' => $user->name,
            'new_password' => $newPassword,
        ];

        Mail::send('emails.new_password', $data, function ($message) use ($user) {
            $message->to($user->email, $user->name)->subject('Nueva Contraseña');
            $message->from('Beneficard@gmail.com', 'Beneficard'); // Reemplaza con tu correo y nombre
        });
    }
}
