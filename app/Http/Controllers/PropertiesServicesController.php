<?php

namespace App\Http\Controllers;

use App\Models\PropertiesService;
use App\Services\PropertiesServicesService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertiesServicesController extends Controller
{
    private PropertiesServicesService $service;
    private $rules = [
        'property_id' => 'required|exists:properties,id',
        'service_type_id' => 'required|exists:service_types,id',
        'name' => 'required|string',
        'is_shared' => 'required|boolean',
        'sub_properties_ids' => 'required_if:is_shared,true|array',
        'sub_properties_ids.*' => 'integer|exists:sub_properties,id',
    ];

    public function __construct(PropertiesServicesService $service)
    {
        $this->middleware('auth:sanctum');
        $this->service = $service;
    }

    public function index()
    {
        return response()->json(PropertiesService::with('property')->get());
    }

    public function store(Request $request)
    {
        $request->validate($this->rules);
        return $this->service->create($request->all());
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
