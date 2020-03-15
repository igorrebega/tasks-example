<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class TaskCollectionResource
 */
class TaskCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request Request
     *
     * @return AnonymousResourceCollection Result
     */
    public function toArray($request): AnonymousResourceCollection
    {
        return TaskResource::collection($this);
    }
}
