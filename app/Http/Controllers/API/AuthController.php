<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        
        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        // Verifica si ya existe un usuario con el mismo correo electrónico
        $existingUser = User::where('email', $request->email)->first();
    
        if ($existingUser) {
            return response()->json([
                'message' => 'El usuario ya existe',
                'user' => $existingUser
            ], 422); // Devuelve un código de estado 422 (Unprocessable Entity) para indicar un error de validación
        }else{
            $user = User::create([
                'first_name' => $request->first_name,
                "last_name" => $request->last_name,
                "birthday" => $request->birthday,
                "address" => $request->address,
                'email' => $request->email,
                "param_city" => $request->param_city,
                "param_rol" => $request->param_rol,
                "param_state" => $request->param_state,
                "image" => $request->image,
                "gender" => $request->gender,
                "type_user" => $request->type_user,
                'password' => Hash::make($request->password),
            ]);
        
            return response()->json([
                'message' => 'Usuario creado exitosamente',
                'user' => $user
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
