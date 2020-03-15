<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TaskResource
 */
class TaskResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request Request
     *
     * @return array Result
     */
    public function toArray($request): array
    {
        return [
            'id' => (int) $this->id,
            'text' => (string) $this->text,
            'id_done' => (bool) $this->is_done,
        ];
    }
}
