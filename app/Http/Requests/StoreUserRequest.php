<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // disesuaikan dengan kebutuhan
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:25',
            'role' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'number' => ['required', 'regex:/^(?:\+62|62|0)8[1-9][0-9]{6,11}$/'],
            'password' => 'nullable|string|min:8',
        ];
    }
}
