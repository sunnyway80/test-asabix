<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Post
 */
class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'slug'        => $this->slug,
            'data'        => $this->getTranslationsArray(),
            //            'title'       => $this->title,
            //            'description' => $this->description,
            //            'content'     => $this->content,
            'tags'        => TagResource::collection(
                $this->whenLoaded('tags')
            ),
        ];
    }
}
