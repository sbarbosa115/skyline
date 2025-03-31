<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ContractsService
{
  public function create($data): JsonResponse
  {
    $property = Property::find($data['property_id']);

    $validationResponse = $this->validateSubPropertyRequirement($property, $data);
    if ($validationResponse instanceof JsonResponse) {
      return $validationResponse;
    }

    if ($this->hasActiveContracts($property, $data)) {
      return $this->errorResponse('This property already has an active contract in this period', Response::HTTP_BAD_REQUEST);
    }

    $contract = Contract::create($data);
    return response()->json($contract, Response::HTTP_CREATED);
  }

  private function validateSubPropertyRequirement(Property $property, array $data): ?JsonResponse
  {
    if ($property->has_sub_properties && empty($data['sub_property_id'])) {
      return $this->errorResponse(
        'Property manages sub-properties, the sub_property_id is required',
        Response::HTTP_BAD_REQUEST
      );
    }

    return null;
  }

  private function hasActiveContracts(Property $property, array $data): bool
  {
    $query = Contract::where('property_id', $data['property_id'])
      ->where('end_date', '>=', $data['start_date'])
      ->where('status', Contract::STATUS_ACTIVE);

    if ($property->has_sub_properties) {
      $query->where('sub_property_id', $data['sub_property_id']);
    }

    return $query->exists();
  }

  private function errorResponse(string $message, int $statusCode): JsonResponse
  {
    return response()->json(['message' => $message], $statusCode);
  }
}
