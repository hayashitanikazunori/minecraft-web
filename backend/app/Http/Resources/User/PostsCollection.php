<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostsCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => PostsResource::collection($this->collection),
            'postsCount' => $this->collection->count(),
        ];
    }
}
