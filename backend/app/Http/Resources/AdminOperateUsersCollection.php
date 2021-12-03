<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminOperateUsersCollection extends ResourceCollection
{
    /**
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => AdminOperateUsersResource::collection($this->collection),
            'count' => $this->collection->count(),
        ];
    }
}
