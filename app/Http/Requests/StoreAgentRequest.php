<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAgentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:agents,email',
        'phone' => 'required|string|max:15|unique:agents,phone',
        'date_of_birth' => 'required|date',
        'pan_number' => 'required|string|unique:agent_kycs,pan_number|size:10',
        'aadhar_number' => 'required|string|unique:agent_kycs,aadhar_number|size:12',

        ];
    }
}
