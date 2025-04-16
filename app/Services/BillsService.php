<?php

namespace App\Services;

use App\Mail\SendBillEmail;
use App\Models\Bill;
use App\Models\SubProperty;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Mail;

class BillsService
{
  public function create($data): JsonResponse
  {
    $subProperty = SubProperty::find($data['sub_property_id']);
    if ($subProperty instanceof JsonResponse) {
      return $subProperty;
    }

    if ($this->billsExistInPeriod($subProperty->id, $data['service_type_id'], $data['period_from'])) {
      return $this->errorResponse('Bills for this period already exist', Response::HTTP_BAD_REQUEST);
    }

    $bill = Bill::create($data);

    if ($data['price'] === null) {
      $data['price'] = round($bill->calculateUnitPrice() * $data['amount'], 2);
    }

    $this->notifyBill($subProperty->landlord);

    return response()->json($bill, Response::HTTP_CREATED);
  }

  private function billsExistInPeriod(int $subPropertyId, int $serviceTypeId, string $periodFrom): bool
  {
    return Bill::where('sub_property_id', $subPropertyId)
      ->where('service_type_id', $serviceTypeId)
      ->where('period_to', '>', $periodFrom)
      ->exists();
  }

  private function errorResponse(string $message, int $statusCode): JsonResponse
  {
    return response()->json(['message' => $message], $statusCode);
  }

  private function notifyBill(User $user): void
  {
    Mail::to($user->email)->send(new SendBillEmail());
  }
}