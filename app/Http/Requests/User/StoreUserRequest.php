<?php

namespace App\Http\Requests\User;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:20',
            ],
            'last_name' => [
                'required',
                'string',
                'max:20',
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::defaults()],
            'role' => 'required',
            'phone' => [
                'required',
                'numeric',
                new PhoneNumber,
                'unique:users'
            ],
        ];
    }
}
