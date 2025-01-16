<?php

namespace App\Services;

use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class PostService
{
    /**
     * Create a new class instance.
     */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPublishedPosts()
    {
        return $this->postRepository->getAllPublished();
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAll();
    }

    public function getPostDetails($id)
    {
        return $this->postRepository->findById($id);
    }

    public function createPost(array $data)

    {
        if (isset($data['featured_image'])) {
            $data['featured_image_path'] = $this->handleImageUpload($data['featured_image_path']);
        }

        return $this->postRepository->create($data);
    }

    public function updatePost(int $id, array $data)
    {
        $post = $this->postRepository->findById($id);
        if (isset($data["remove_image"])) {
            Storage::delete($post->featured_image_path);
        }

        $data['featured_image_path'] = $data['featured_image_path'] ?? $post->featured_image_path;

        return $this->postRepository->update($id, $data);
    }

    private function handleImageUpload($image)
    {
        return $image->store('images', 'public');
    }

    public function deletePost($id)
    {

        $post = $this->postRepository->findById($id);
        $this->postRepository->delete($post->id);
    }
}
