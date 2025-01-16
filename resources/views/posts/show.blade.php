@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="max-w-4xl mx-auto bg-white rounded-lg shadow-sm overflow-hidden">
        @if($post->featured_image_path)
            <div class="aspect-w-16 aspect-h-9">
                <img src="{{ asset('storage/' . $post->featured_image_path) }}"
                     alt="{{ $post->title }}"
                     class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-8">
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
                <span>{{ $post->author->name }}</span>
                <span>&bull;</span>
                <time datetime="{{ $post->created_at }}">
                    {{ $post->created_at->format('F d, Y') }}
                </time>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-6">
                {{ $post->title }}
            </h1>

            <div class="prose max-w-none">
                {!! nl2br(e($post->content)) !!}
            </div>

            @canany(['edit posts', 'delete posts'])
                <div class="mt-8 pt-8 border-t border-gray-200 flex justify-end space-x-4">
                    @can('edit posts')
                        <a href="{{ route('posts.edit', $post) }}"
                           class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                            Edit Post
                        </a>
                    @endcan

                    @can('delete posts')
                        <form action="{{ route('posts.destroy', $post) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                Delete Post
                            </button>
                        </form>
                    @endcan
                </div>
            @endcanany
        </div>
    </article>
@endsection
