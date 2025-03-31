<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePropertiesServicesRequest;
use App\Models\PropertiesService;
use App\Services\PropertiesServicesService;
use Illuminate\Http\Response;

class PropertiesServicesController extends Controller
{
    private PropertiesServicesService $service;

    public function __construct(PropertiesServicesService $service)
    {
        $this->middleware('auth:sanctum');
        $this->service = $service;
    }

    public function index()
    {
        return response()->json(PropertiesService::with('property')->get());
    }

    public function store(SavePropertiesServicesRequest $request)
    {
        return $this->service->create($request->validated());
    }

    public function show(string $id)
    {
        $propertiesService = PropertiesService::with('property')->findOrFail($id);

        return response()->json($propertiesService);
    }

    public function update(SavePropertiesServicesRequest $request, string $id)
    {
        $propertiesService = PropertiesService::findOrFail($id);
        $propertiesService->update($request->validated());

        return response()->json($propertiesService);
    }

    public function destroy(string $id)
    {
        PropertiesService::destroy($id);
        
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
