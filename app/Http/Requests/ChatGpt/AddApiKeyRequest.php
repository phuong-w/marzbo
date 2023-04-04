<?php

namespace App\Http\Requests\ChatGpt;

use App\Rules\CheckOpenaiApiKey;
use Illuminate\Foundation\Http\FormRequest;

class AddApiKeyRequest extends FormRequest
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
            'openai_api_key' => ['required', new CheckOpenaiApiKey]
        ];
    }
}
