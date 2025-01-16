@extends('layouts.app')

@section('title', 'Posts')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Blog Posts</h1>
        @can('create posts')
            <a href="{{ route('posts.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Create New Post
            </a>
        @endcan
    </div>

    <div class="grid gap-6">
        @forelse($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($post->content, 200) }}
                        </p>
                        <div class="text-sm text-gray-500">
                            By {{ $post->author->name }} |
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    @if($post->featured_image_path)
                        <img src="{{ asset('storage/' . $post->featured_image_path) }}"
                             alt="{{ $post->title }}"
                             class="w-32 h-32 object-cover rounded">
                    @endif
                </div>

                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('posts.show', $post) }}"
                       class="text-blue-500 hover:underline">
                        Read More
                    </a>

                    @can('edit posts')
                        <a href="{{ route('posts.edit', $post) }}"
                           class="text-yellow-500 hover:underline">
                            Edit
                        </a>
                    @endcan

                    @can('delete posts')
                        <form action="{{ route('posts.destroy', $post) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure?');"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-500 hover:underline">
                                Delete
                            </button>
                        </form>
                    @endcan

                    @can('publish posts')
                        @if(!$post->is_published)
                            <form action="{{ route('blogs.publish', $post) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                <button type="submit"
                                        class="text-green-500 hover:underline">
                                    Publish
                                </button>
                            </form>
                        @else
                            <form action="{{ route('blogs.unpublish', $post) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                <button type="submit"
                                        class="text-gray-500 hover:underline">
                                    Unpublish
                                </button>
                            </form>
                        @endif
                    @endcan
                </div>
            </div>
        @empty
            <p class="text-gray-500">No blog posts found.</p>
        @endforelse

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
