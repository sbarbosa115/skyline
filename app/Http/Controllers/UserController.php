<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
	private array $rules = [
		'unit_number' => 'required|string|max:255',
		'property_id' => 'required|exists:properties,id',
	];

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
		$validated = $request->validate($this->rules);
		$user = User::create($validated);

		return response()->json($user, Response::HTTP_CREATED);
	}

	public function show(User $user)
	{
		return $user;
	}

	public function update(Request $request, User $user)
	{
		$validated = $request->validate($this->rules);
		$user->update($validated);

		return response()->json($user);
	}

	public function destroy(User $user)
	{
		$user->delete();
		
		return response()->json(null, Response::HTTP_NO_CONTENT);
	}
}
