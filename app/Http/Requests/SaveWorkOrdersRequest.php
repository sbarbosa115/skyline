<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveWorkOrdersRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'sub_property_id' => 'required|exists:sub_properties,id',
      'description' => 'required|string|max:255',
      'status'  => 'nullable|in:opened,in_progress,closed',
    ];
  }
}
