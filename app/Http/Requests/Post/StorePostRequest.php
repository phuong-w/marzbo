<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'scheduled_time' => [
                'nullable',
                'date',
                'after:' . now()->addMinutes(5)->toDateTimeString(),
            ],
//            'category_id' => ['required'],
            'content' => ['required'],
            'files' => ['sometimes'],
            'facebook_group' => ['sometimes'],
        ];
    }
}
