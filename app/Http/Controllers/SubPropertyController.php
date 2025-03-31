<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSubPropertyRequest;
use App\Models\SubProperty;
use Illuminate\Http\Response;

class SubPropertyController extends Controller
{
    public function index()
    {
        return response()->json(SubProperty::with('property')->get());
    }

    public function store(SaveSubPropertyRequest $request)
    {
        $subProperty = SubProperty::create($request->validated());

        return response()->json($subProperty, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $subProperty = SubProperty::with('property')->findOrFail($id);

        return response()->json($subProperty);
    }

    public function update(SaveSubPropertyRequest $request, $id)
    {
        $subProperty = SubProperty::findOrFail($id);
        $subProperty->update($request->validated());

        return response()->json($subProperty);
    }

    public function destroy($id)
    {
        SubProperty::destroy($id);
        
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
