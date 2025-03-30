<?php

namespace App\Http\Controllers;

use App\Models\PropertiesService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertiesServicesController extends Controller
{
    private $rules = [
        'property_id' => 'required|exists:properties,id',
        'service_id' => 'required|exists:service_types,id',
        'is_shared' => 'required|boolean',
        'sub_properties_ids' => 'required_if:is_shared,true|array',
        'sub_properties_ids.*' => 'integer|exists:sub_properties,id',
    ];

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return response()->json(PropertiesService::with('property')->get());
    }

    public function store(Request $request)
    {
        $request->validate($this->rules);
        $internalBill = PropertiesService::create($request->all());

        return response()->json($internalBill, Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        $propertiesService = PropertiesService::with('property')->findOrFail($id);

        return response()->json($propertiesService);
    }

    public function update(Request $request, string $id)
    {
        $propertiesService = PropertiesService::findOrFail($id);

        $request->validate($this->rules);
        $propertiesService->update($request->all());

        return response()->json($propertiesService);
    }

    public function destroy(string $id)
    {
        PropertiesService::destroy($id);
        
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
