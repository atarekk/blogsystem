<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Exception;
use HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    function index()
    {
        try {
            $posts = auth()->user()?->isAdmin()
                ? $this->postService->getAllPosts()
                : $this->postService->getAllPublishedPosts();
            return PostResource::collection($posts);
        } catch (\Exception $e) {
            Log::error('Failed to fetch posts: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch posts'], 500);
        }
    }

    public function showPost(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        $post = $this->postService->getPostDetails($validated['post_id']);
        if ($post) {
            try {
                if (!auth()->user()->isAdmin() && $post->is_published != true) {
                    abort(403, 'Unauthorized access');
                }

                return response()->json(new PostResource($post->load('author')));


            } catch (ModelNotFoundException|NotFoundHttpException  $e) {

                return response()->json(['error' => 'Post not found'], 404);


            } catch (Exception $e) {
                Log::error('Error fetching post: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch post'
                ], 500);
            }
        } else {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }

}
