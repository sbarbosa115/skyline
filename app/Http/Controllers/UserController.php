<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
	public function index(Request $request)
	{
		$query = User::query();

		if ($request->has('role')) {
			$query->where('role', $request->input('role'));
		}

		if ($request->has('status')) {
			$query->where('status', $request->input('status'));
		}

		return $query->get();
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|unique:users',
			'password' => 'required|string|min:8',
			'role' => 'required|in:Administrator,Reader,Lessor,Lessee',
		]);

		$user = User::create($validated);
		return response()->json($user, Response::HTTP_CREATED);
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
			'role' => 'sometimes|in:Administrator,Reader,Lessor,Lessee',
		]);

		$user->update($validated);
		return response()->json($user);
	}

	public function destroy(User $user)
	{
		$user->delete();
		return response()->json(null, Response::HTTP_NO_CONTENT);
	}
}
