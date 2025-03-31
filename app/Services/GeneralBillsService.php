<?php

namespace App\Services;

use App\Models\GeneralBill;
use App\Models\Property;
use App\Models\SubProperty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GeneralBillsService
{
  public function create(array $data): JsonResponse
  {
    $property = Property::find($data['property_id']);

    $subProperty = $this->validateSubProperty($data, $property);
    if ($subProperty instanceof JsonResponse) {
      return $subProperty;
    }

    if ($this->billsExistInPeriod($property->id, $data['service_type_id'], $data['period_from'])) {
      return $this->errorResponse('Bills for this period already exist', Response::HTTP_BAD_REQUEST);
    }

    $data['sub_property_id'] = $data['sub_property_id'] ?? null;
    $bill = GeneralBill::create($data);

    return response()->json($bill, Response::HTTP_CREATED);
  }

  private function validateSubProperty(array $data, Property $property): ?JsonResponse
  {
    if (!isset($data['sub_property_id'])) {
      return null;
    }

    $subProperty = SubProperty::find($data['sub_property_id']);
    if (!$subProperty) {
      return $this->errorResponse('SubProperty not found', Response::HTTP_NOT_FOUND);
    }

    if ($property->id !== $subProperty->property_id) {
      return $this->errorResponse('SubProperty does not belong to Property', Response::HTTP_BAD_REQUEST);
    }

    return null;
  }

  private function billsExistInPeriod(int $propertyId, int $serviceTypeId, string $periodFrom): bool
  {
    return GeneralBill::where('property_id', $propertyId)
      ->where('service_type_id', $serviceTypeId)
      ->where('period_to', '>', $periodFrom)
      ->exists();
  }

  private function errorResponse(string $message, int $statusCode): JsonResponse
  {
    return response()->json(['message' => $message], $statusCode);
  }
}