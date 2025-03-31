<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
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

	public function store(SaveUserRequest $request)
	{
		$user = User::create($request->validated());

		return response()->json($user, Response::HTTP_CREATED);
	}

	public function show(User $user)
	{
		return $user;
	}

	public function update(SaveUserRequest $request, User $user)
	{
		$user->update($request->validated());

		return response()->json($user);
	}

	public function destroy(User $user)
	{
		$user->delete();
		
		return response()->json(null, Response::HTTP_NO_CONTENT);
	}
}
