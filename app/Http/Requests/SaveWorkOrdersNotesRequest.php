<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveWorkOrdersNotesRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'work_order_id' => 'required|exists:work_orders,id',
      'description' => 'required|string|max:255',
    ];
  }
}
