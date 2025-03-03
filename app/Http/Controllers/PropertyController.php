<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
	public function index()
	{
		return Property::with('landlord')->get();
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'description' => 'nullable|string',
			'landlord_id' => 'required|exists:users,id',
		]);

		$property = Property::create($validated);
		return response()->json($property, 201);
	}

	public function show(Property $property)
	{
		return $property->load('landlord');
	}

	public function update(Request $request, Property $property)
	{
		$validated = $request->validate([
			'name' => 'sometimes|string|max:255',
			'description' => 'nullable|string',
			'landlord_id' => 'sometimes|exists:users,id',
		]);

		$property->update($validated);
		return response()->json($property);
	}

	public function destroy(Property $property)
	{
		$property->delete();
		return response()->json(null, 204);
	}
}
