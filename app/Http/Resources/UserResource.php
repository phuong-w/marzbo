<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'status' => $this->status,
            'token' => $this->token,
            'roles' => RoleResource::collection($this->roles),
            'permissions' => array_map(
                function ($permission) {
                    return $permission['name'];
                },
                $this->getAllPermissions()->toArray()
            ),
            'role' => isset($this->roles[0]) ? $this->roles[0]->name : '',
            'avatar' => $this->avatar,
            'reset_password_at' => $this->reset_password_at,
            'facebook_credential' => $this->getFacebookCredential(),
            'created_at' => $this->created_at
        ];
    }
}
