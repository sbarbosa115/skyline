<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveInternalBillsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'general_bill_id' => 'required|exists:general_bills,id',
            'property_id' => 'required|exists:properties,id',
            'sub_property_id' => 'required|exists:sub_properties,id',
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'price' => 'nullable|numeric|min:0|max:99999999.99',
            'payment_status' => 'required|in:pending,paid',
            'proof_of_payment' => 'nullable|string|max:255',
        ];
    }
}
