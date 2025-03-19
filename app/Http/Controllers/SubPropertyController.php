<?php

namespace App\Http\Controllers;

use App\Models\SubProperty;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubPropertyController extends Controller
{
     /**
     * Display a listing of the subproperties.
     */
    public function index()
    {
        return response()->json(SubProperty::with('property')->get());
    }

    /**
     * Store a newly created subproperty in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_number' => 'required|string|max:255',
            'property_id' => 'required|exists:properties,id',
        ]);

        $subProperty = SubProperty::create($request->all());

        return response()->json($subProperty, Response::HTTP_CREATED);
    }

    /**
     * Display the specified subproperty.
     */
    public function show($id)
    {
        $subProperty = SubProperty::with('property')->findOrFail($id);
        return response()->json($subProperty);
    }

    /**
     * Update the specified subproperty in storage.
     */
    public function update(Request $request, $id)
    {
        $subProperty = SubProperty::findOrFail($id);

        $request->validate([
            'unit_number' => 'required|string|max:255',
            'property_id' => 'required|exists:properties,id',
        ]);

        $subProperty->update($request->all());

        return response()->json($subProperty);
    }

    /**
     * Remove the specified subproperty from storage.
     */
    public function destroy($id)
    {
        SubProperty::destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
