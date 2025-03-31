<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveGeneralBillsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'property_id' => 'required|exists:properties,id',
            'sub_property_id' => 'nullable|exists:sub_properties,id',
            'service_type_id' => 'required|exists:service_types,id',
            'period_from' => 'required|date',
            'period_to' => 'required|date|after_or_equal:period_from',
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'payment_status' => 'required|in:pending,paid',
        ];
    }
}
