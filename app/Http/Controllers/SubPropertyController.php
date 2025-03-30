<?php

namespace App\Http\Controllers;

use App\Models\SubProperty;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubPropertyController extends Controller
{
    private array $rules = [
        'unit_number' => 'required|string|max:255',
        'property_id' => 'required|exists:properties,id',
    ];

    public function index()
    {
        return response()->json(SubProperty::with('property')->get());
    }

    public function store(Request $request)
    {
        $request->validate($this->rules);
        $subProperty = SubProperty::create($request->all());

        return response()->json($subProperty, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $subProperty = SubProperty::with('property')->findOrFail($id);

        return response()->json($subProperty);
    }

    public function update(Request $request, $id)
    {
        $subProperty = SubProperty::findOrFail($id);
        $request->validate($this->rules);
        $subProperty->update($request->all());

        return response()->json($subProperty);
    }

    public function destroy($id)
    {
        SubProperty::destroy($id);
        
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
