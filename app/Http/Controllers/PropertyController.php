<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePropertiesRequest;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
	public function index(Request $request)
	{
		$query = Property::with('landlord');

		if ($request->has('landlord_id')) {
			$query->where('landlord_id', $request->input('landlord_id'));
		}

		return $query->get();
	}

	public function store(SavePropertiesRequest $request)
	{
		$property = Property::create($request->validated());

		return response()->json($property, Response::HTTP_CREATED);
	}

	public function show(Property $property)
	{
		return $property->load('landlord');
	}

	public function update(SavePropertiesRequest $request, Property $property)
	{
		$property->update($request->validated());

		return response()->json($property);
	}

	public function destroy(Property $property)
	{
		$property->delete();
		
		return response()->json(null, Response::HTTP_NO_CONTENT);
	}
}
