@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Post</h1>

            @can('publish posts')
                <div class="flex space-x-4">
                    @if(!$post->is_published)
                        <form action="{{ route('posts.publish', $post) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Publish
                            </button>
                        </form>
                    @else
                        <form action="{{ route('posts.unpublish', $post) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                                Unpublish
                            </button>
                        </form>
                    @endif
                </div>
            @endcan
        </div>

        <form action="{{ route('posts.update', $post) }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white rounded-lg shadow-sm p-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Title
                    </label>
                    <x-form-input type="text"
                                  name="title"
                                  id="title"
                                  value="{{ old('title', $post->title) }}"
                                  class="mt-1 block w-full"
                                  :error="$errors->first('title')" />
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">
                        Content
                    </label>
                    <textarea name="content"
                              id="content"
                              rows="10"
                              class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Current Featured Image
                    </label>
                    @if($post->featured_image_path)
                        <div class="mt-2 relative">
                            <img src="{{ asset('storage/' . $post->featured_image_path) }}"
                                 alt="Current featured image"
                                 class="max-h-48 rounded-lg">
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox"
                                           name="remove_image"
                                           class="rounded border-gray-300 text-red-600">
                                    <span class="ml-2 text-sm text-gray-600">Remove current image</span>
                                </label>
                            </div>
                        </div>
                    @else
                        <p class="mt-2 text-sm text-gray-500">No featured image currently set</p>
                    @endif

                    <div class="mt-4">
                        <label for="featured_image" class="block text-sm font-medium text-gray-700">
                            Upload New Featured Image
                        </label>
                        <input type="file"
                               name="featured_image"
                               id="featured_image"
                               class="mt-1 block w-full"
                               accept="image/*">
                        @error('featured_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox"
                           name="is_published"
                           id="is_published"
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                    <label for="is_published" class="ml-2 block text-sm text-gray-700">
                        Published
                    </label>
                </div>



                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <span>Created by {{ $post->author->name }}</span>
                        <span>&bull;</span>
                        <span>{{ $post->created_at->format('M d, Y H:i') }}</span>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('posts.show', $post) }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Update Post
                        </button>
                    </div>
                </div>
            </div>
        </form>

        @can('delete posts')
            <div class="mt-6">
                <form action="{{ route('posts.destroy', $post) }}"
                      method="POST"
                      class="flex justify-end"
                      onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-red-600 hover:text-red-900">
                        Delete this post
                    </button>
                </form>
            </div>
        @endcan
    </div>
@endsection
