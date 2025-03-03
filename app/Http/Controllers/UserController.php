<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index()
	{
		return User::all();
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|unique:users',
			'password' => 'required|string|min:8',
			'role' => 'required|in:Administrator,Reader,Arrendatario,Arrendador',
		]);

		$user = User::create($validated);
		return response()->json($user, 201);
	}

	public function show(User $user)
	{
		return $user;
	}

	public function update(Request $request, User $user)
	{
		$validated = $request->validate([
			'name' => 'sometimes|string|max:255',
			'email' => 'sometimes|string|email|unique:users,email,' . $user->id,
			'password' => 'sometimes|string|min:8',
			'role' => 'sometimes|in:Administrator,Reader,Arrendatario,Arrendador',
		]);

		$user->update($validated);
		return response()->json($user);
	}

	public function destroy(User $user)
	{
		$user->delete();
		return response()->json(null, 204);
	}
}
