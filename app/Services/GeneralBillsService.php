<?php

use App\Models\GeneralBill;
use App\Models\Property;
use App\Models\ServiceType;
use App\Models\SubProperty;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GeneralBillsService
{
  public function create($data = []): JsonResponse {
    $property = Property::find($data['property_id']);
    $subProperty = null;

    if ($data['sub_property_id']) {
      $subProperty = SubProperty::find($data['sub_property_id']);
      if ($property->id != $subProperty->property_id) {
        return response()->json([
          'message' => 'SubProperty does not belong to Property'
        ], Response::HTTP_BAD_REQUEST);;
      }
    }

    $serviceType = ServiceType::find($data['service_type_id']);
    GeneralBill::validate($data, $property, $subProperty, $serviceType);
    
    
    $bill = GeneralBill::create($data);

    return response()->json($bill, Response::HTTP_CREATED);
  }
}