<?php

namespace App\Services;

use App\Models\PropertiesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PropertiesServicesService
{
  public function create($data): JsonResponse
  {
    $propertiesService = PropertiesService::create($data);
    foreach ($data['sub_properties_ids'] as $subPropertyId) {
      $propertiesService->sharedServices()->create([
        'sub_property_id' => $subPropertyId
      ]);
    }

    return response()->json($propertiesService, Response::HTTP_CREATED);
  }
}