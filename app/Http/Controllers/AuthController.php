<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
	public function register(RegisterRequest $request)
	{
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'role' => $request->role,
		]);
		$user->assignRole($request->role);

		return \response()->json(['message' => 'Usuario registrado correctamente'], 201);
	}

	public function login(LoginRequest $request)
	{
		$user = User::where('email', $request->email)->first();

		if (!$user || !Hash::check($request->password, $user->password)) {
			return response()->json(['error' => 'Credenciales inválidas'], 401);
		}

		$token = $user->createToken('auth_token')->plainTextToken;

		return response()->json(['token' => $token], 200);
	}

	public function logout(Request $request)
	{
		$request->user()->currentAccessToken()->delete();

		return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
	}
}
