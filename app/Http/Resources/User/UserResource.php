<?php

namespace App\Http\Resources\User;

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
        $permissions = [];
        $roles = [];
        if ($this->relationLoaded('roles')) {
            $roles = array_map(
                function ($role) {
                    return $role['name'];
                },
                $this->roles->toArray()
            );
        }
        if ($this->relationLoaded('permissions')) {
            $permissions = array_map(
                function ($permission) {
                    return $permission['name'];
                },
                $this->getAllPermissions()->toArray()
            );
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->token,
            'roles' => $this->whenLoaded('roles', $this->roles),
            'permissions' => $permissions,
            'role' => $this->whenLoaded('roles', $this->roles->first()->name),
            'avatar' => $this->avatar,
            'reset_password_at' => $this->reset_password_at,
            'created_at' => $this->created_at
        ];
    }
}
