<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use OpenAI;

class CheckOpenaiApiKey implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->testApiKey($value)) {
            $fail(__('error.chat_gpt.incorrect_api_key', ['key' => $value]));
        }
    }

    /**
     * Check api key is correct?
     */
    private function testApiKey($value)
    {
        try {
            $client = OpenAI::client($value);

            return $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => 'Hello!'],
                ],
            ]);
        } catch (\Exception $e) {
            return false;
        }
    }
}
