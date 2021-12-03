<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminOperateUsersResource extends JsonResource
{
    /**
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'postsCount' => $this->posts->count(),
            'freezingStatus' => $this->freezing_status,
            'createdAt' => $this->created_at->format('Y/m/d H:i'),
        ];
    }
}
