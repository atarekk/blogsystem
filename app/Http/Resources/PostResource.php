<?php

namespace App\Http\Resources;

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
        return [
            "message" => "success",
            "data" => [
                'id' => $this->id,
                'title' => $this->title,
                'content' => $this->content,
                'featured_image' => $this->featured_image_path ? asset('storage/' . $this->featured_image) : null,
                'status' => $this->is_published,
                'author' => [
                    'id' => $this->author->id,
                    'name' => $this->author->name
                ],
                'created_at' => $this->created_at->toDateTimeString(),
                'updated_at' => $this->updated_at->toDateTimeString()
            ]
        ];
    }
}
