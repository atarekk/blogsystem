@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Create New Post</h1>

        <form action="{{ route('posts.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white rounded-lg shadow-sm p-8">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Title
                    </label>
                    <x-form-input type="text"
                                  name="title"
                                  id="title"
                                  value="{{ old('title') }}"
                                  class="mt-1 block w-full"
                                  :error="$errors->first('title')"/>
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">
                        Content
                    </label>
                    <textarea name="content"
                              id="content"
                              rows="10"
                              class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('content') }}</textarea>
                    @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700">
                        Featured Image
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

                <div class="flex items-center">
                    <input type="checkbox"
                           name="is_published"
                           id="is_published"
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        {{ old('is_published') ? 'checked' : '' }}>
                    <label for="is_published" class="ml-2 block text-sm text-gray-700">
                        Publish immediately
                    </label>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('posts.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Create Post
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
