<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'social_media_name' => SOCIAL_MEDIAS[$this->social_media_id],
            'post' => new PostResource($this->post),
            'publish_date' => $this->publish_date,
            'publish_date_formated' => Carbon::parse($this->publish_date)->isoFormat('MMM Do YYYY - h\h:m\p'),
            'status' => $this->status,
            'status_name' => trans('general.schedule.status')[$this->status]['name'],
            'badge' => SCHEDULE_STATUSES[$this->status]['badge_outline']
        ];
    }
}
