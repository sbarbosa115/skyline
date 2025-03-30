<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
	private array $rules = [
		'name' => 'required|string|max:255',
		'description' => 'nullable|string',
		'landlord_id' => 'required|exists:users,id',
	];

	public function index(Request $request)
	{
		$query = Property::with('landlord');

		if ($request->has('landlord_id')) {
			$query->where('landlord_id', $request->input('landlord_id'));
		}

		return $query->get();
	}

	public function store(Request $request)
	{
		$validated = $request->validate($this->rules);
		$property = Property::create($validated);

		return response()->json($property, Response::HTTP_CREATED);
	}

	public function show(Property $property)
	{
		return $property->load('landlord');
	}

	public function update(Request $request, Property $property)
	{
		$validated = $request->validate($this->rules);
		$property->update($validated);

		return response()->json($property);
	}

	public function destroy(Property $property)
	{
		$property->delete();
		
		return response()->json(null, Response::HTTP_NO_CONTENT);
	}
}
