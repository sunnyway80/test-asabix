<?php

namespace App\Http\Resources;

use App\Models\Tag;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Tag
 */
class TagResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    => $this->id,
            'data'  => $this->getTranslationsArray(),
            'posts' => PostResource::collection(
                $this->whenLoaded('posts')
            ),
        ];
    }
}
