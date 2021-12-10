<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'thumbnailImages' => $this->thumbnail_images,
            'description' => $this->description,
            'material' => $this->material,
            'recipe' => $this->recipe,
            'postBy' => $this->user->name,
            'createdAt' => $this->created_at->format('Y/m/d H:i'),
        ];
    }
}
