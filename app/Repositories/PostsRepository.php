<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostsRepository implements PostRepositoryInterface
{


    public function getAllPublished()
    {
        return Post::where('is_published', true)
            ->with('author')
            ->latest()
            ->paginate(10);
    }

    public function getAll()
    {
        return Post::with('author')
            ->latest()
            ->paginate(10);
    }

    public function findById(int $id)
    {
        return Post::with('author')->findOrFail($id);

    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update(int $id, array $data)
    {
        $post = $this->findById($id);
        $post->update($data);
        return $post;
    }

    public function delete(int $id)
    {
        return Post::destroy($id);

    }
}
