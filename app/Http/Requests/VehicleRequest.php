<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => 'required',
            'request_date' => 'required|date',
            'maximum_person' => 'required|string|max:50',
            'direction' => 'required|string|max:255',
            'necessity' => 'required|string|max:255',
            'noted' => 'nullable|string'
        ];

        return $rules;
    }
}
