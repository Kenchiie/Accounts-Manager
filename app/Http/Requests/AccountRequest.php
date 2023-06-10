<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'platform' => ['required', 'max:255'],
            'email' => ['nullable', 'email'],
            'username' => ['nullable', 'max:255'],
            'mobile_numbers.*' => ['nullable'],
            'password' => ['nullable', 'max:255'],
            'pin' => ['nullable', 'numeric'],
            'note' => ['nullable'],
        ];
    }
}
