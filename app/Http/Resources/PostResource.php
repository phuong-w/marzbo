<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'user' => new UserResource($this->user),
            'social_media_id' => $this->social_media_id,
            'social_media_name' => SOCIAL_MEDIAS[$this->social_media_id],
            'content' => $this->content,
            'total_react' => $this->total_react,
            'total_view' => $this->total_view,
            'total_comment' => $this->total_comment,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
