<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePropertiesServicesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'property_id' => 'required|exists:properties,id',
            'service_type_id' => 'required|exists:service_types,id',
            'name' => 'required|string',
            'is_shared' => 'required|boolean',
            'sub_properties_ids' => 'required_if:is_shared,true|array',
            'sub_properties_ids.*' => 'integer|exists:sub_properties,id',
        ];
    }
}
