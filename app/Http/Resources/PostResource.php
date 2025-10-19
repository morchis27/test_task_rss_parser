<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Post $this */
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'link'        => $this->link,
            'description' => $this->description,
            'pub_date'    => $this->pub_date,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
