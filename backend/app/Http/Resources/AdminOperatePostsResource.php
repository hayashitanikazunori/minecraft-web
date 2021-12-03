<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminOperatePostsResource extends JsonResource
{
    /**
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'publicingStatus' => $this->publicing_status,
            'postBy' => $this->user->name,
            'createdAt' => $this->created_at->format('Y/m/d H:i'),
        ];
    }
}
