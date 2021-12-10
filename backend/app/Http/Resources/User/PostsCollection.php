<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostsCollection extends ResourceCollection
{
    /**
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => PostsResource::collection($this->collection),
            'count' => $this->collection->count(),
        ];
    }
}
