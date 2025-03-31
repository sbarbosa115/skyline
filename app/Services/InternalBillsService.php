<?php

namespace App\Services;

use App\Models\GeneralBill;
use App\Models\InternalBill;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class InternalBillsService
{
  public function create($data): JsonResponse
  {
    $property = Property::find($data['property_id']);
    if (!$property->has_sub_properties) {
      return response()->json(['message' => 'Property does not have sub properties'], Response::HTTP_BAD_REQUEST);
    }

    $generalBill = GeneralBill::find($data['general_bill_id']);
    if ($data['amount'] > $generalBill->amount || $data['price'] > $generalBill->price) {
      return response()->json(['message' => 'Amount or price cannot be greater than GeneralBill'], Response::HTTP_BAD_REQUEST);
    }

    $internalBill = InternalBill::where('general_bill_id', $data['general_bill_id'])
      ->where('sub_property_id', $data['sub_property_id'])
      ->first();
    if ($internalBill) {
      return response()->json(['message' => 'SubProperty already has an InternalBill for this GeneralBill'], Response::HTTP_BAD_REQUEST);
    }

    // If price is not provided, calculate it
    if ($data['price'] === null) {
      $data['price'] = round($generalBill->calculateUnitPrice() * $data['amount'], 2);
    }

    $internalBill = InternalBill::create($data);

    return response()->json($internalBill, Response::HTTP_CREATED);
  }


  private function notifyConsumption($data): void
  {
    
  }
}