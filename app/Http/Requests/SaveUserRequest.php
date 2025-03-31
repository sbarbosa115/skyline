<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'unit_number' => 'required|string|max:255',
		    'property_id' => 'required|exists:properties,id',
        ];
    }
}
