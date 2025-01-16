<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;

    public function __construct( PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = auth()->user()?->isAdmin()
            ? $this->postService->getAllPosts()
            : $this->postService->getAllPublishedPosts();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $imagePath = $request->file('featured_image') ?
            $request->file('featured_image')->store('images', 'public') : null;
        $this->postService->createPost([
            'author_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'featured_image_path' => $imagePath,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = $this->postService->getPostDetails($id);
        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $imagePath = $request->file('featured_image') ?
            $request->file('featured_image')->store('images', 'public') : null;
        $this->postService->updatePost($id, [
            'title' => $request->title,
            'content' => $request->content,
            'featured_image_path' => $imagePath,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $this->postService->deletePost($id);
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = $this->postService->getPostDetails($id);
        return view('posts.show', compact('post'));
    }

}
