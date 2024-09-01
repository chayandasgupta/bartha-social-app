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
            'id' => $this->id,
            'description' => $this->description,
            'user_id' => $this->user_id,
            'user' => UserResource::make($this->whenLoaded('user')),
            'comments' => CommentsResource::collection($this->whenLoaded('comments')),
            'view_count' => $this->view_count,
            'post_image' => $this->getPostImage(),
            'created_at' => $this->created_at ? $this->created_at->diffForHumans() : null,
            'comments_count' => $this->whenCounted('comments'),
            'likes_count' => $this->whenCounted('likes'),
            'can' => [
                'edit' => $request->user()->id === $this->user_id,
                'delete' => $request->user()->id === $this->user_id,
            ],
        ];
    }
}