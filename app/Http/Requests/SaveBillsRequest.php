<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveBillsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sub_property_id' => 'required|exists:sub_properties,id',
            'service_type_id' => 'required|exists:service_types,id',
            'period_from' => 'required|date',
            'period_to' => 'required|date|after_or_equal:period_from',
            'payment_date' => 'nullable|date|after:period_to',
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'price' => 'nullable|numeric|min:0|max:99999999.99',
            'payment_status' => 'nullable|in:generated,sent,paid',
        ];
    }
}
