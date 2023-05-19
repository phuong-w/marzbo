<?php

namespace App\Http\Requests\User;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
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
            'roles' => 'required',
            'phone' => [
                'sometimes',
                'numeric',
                'unique:users,phone,' . $this->user->id,
                new PhoneNumber
            ],
        ];
    }
}
