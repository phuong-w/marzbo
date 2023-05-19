<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'status_name' => POST_STATUSES[$this->status],
            'created_at' => Carbon::parse($this->created_at)->isoFormat('MMM Do YYYY - h\h:m\p'),
            'updated_at' => $this->status === POST_STT_PUBLISHED ? Carbon::parse($this->updated_at)->isoFormat('MMM Do YYYY - h\h:m\p') : 'N/A',
            'schedule_time' => $this->schedule ? Carbon::parse($this->schedule->publish_date)->isoFormat('MMM Do YYYY - h\h:m\p') : 'N/A',

        ];
    }
}
