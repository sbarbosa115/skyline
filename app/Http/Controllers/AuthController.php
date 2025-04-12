<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Response;

class AuthController extends Controller
{
	public function register(RegisterRequest $request)
	{
		try {
			$user = User::create([
				'name' => $request->name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
				'role' => $request->role,
			]);
			$user->assignRole($request->role);
		} catch (\Exception $e) {
			return \response()->json(['error' => 'Error registering user'], Response::HTTP_INTERNAL_SERVER_ERROR);
		}

		return response()->json([
			'message' => 'Error registering user',
			'user' => $user->only(['name', 'email', 'role']),
		], 201);
	}

	public function login(LoginRequest $request)
	{
		$user = User::where('email', $request->email)->first();

		if (!$user || !Hash::check($request->password, $user->password)) {
			return response()->json(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
		}

		$token = $user->createToken('auth_token')->plainTextToken;

		return response()->json(['token' => $token], Response::HTTP_OK);
	}

	public function logout(Request $request)
	{
		$request->user()->currentAccessToken()->delete();

		return response()->json(['message' => 'Logout successful'], Response::HTTP_OK);
	}
}
