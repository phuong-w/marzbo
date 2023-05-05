<?php

namespace App\Http\Resources\Facebook;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacebookGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'social_media_credential_id' => $this->social_media_credential_id,
            'user_id' => $this->user_id,
            'group_id' => $this->group_id,
            'group_name' => $this->group_name,
            'credentials' => $this->credentials
        ];
    }
}
