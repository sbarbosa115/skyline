<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePropertiesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'landlord_id' => 'required|exists:users,id',
        ];
    }
}
