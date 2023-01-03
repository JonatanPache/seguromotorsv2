<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\BaseController as BaseController;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            if(!$user){
                return sendError('Email incorrecto.');
            }else if(!Hash::check($request->password, $user->password)){
                return sendError('Contrasena incorrecto.');
            }
            /*throw ValidationException::withMessages([
                'email' => ['Las credenciales son incorrectas.'],
            ]);*/
            /*
            return response()->json([
                'status' => false,
                'message' => 'Entrada invalidad para email o password',
                'error' => $request->errors()
            ], 422);*/
        }
        $tokn = $user->createToken($request->device_name)->plainTextToken;
        $user->update(['remember_token' => $tokn]);
        return $this->sendResponse($user, 'Usuario logeado exitosamente.');
        //return $user->createToken($request->device_name)->plainTextToken;
    }

    public function logout(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            $user->tokens()->delete();
        }
        return response()->noContent();
    }
}
