<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        return [
            'name' => 'nullable|string|max:25',
            'role' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . $this->route('account')->id,
            'number' => ['nullable', 'regex:/^(?:\+62|62|0)8[1-9][0-9]{6,11}$/'],
            'password' => 'nullable|string|min:8',
        ];
    }
}
