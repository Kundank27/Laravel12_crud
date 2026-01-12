@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow rounded p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Edit Product
        </h2>

        <a href="{{ route('dashboard') }}"
           class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
            ← Back to List
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <ul class="mb-4 text-red-600 dark:text-red-400 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST"
          action="{{ route('products.update', $product->id) }}"
          enctype="multipart/form-data"
          class="space-y-4">

        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Category
            </label>
            <select name="category_id"
                    class="w-full mt-1 rounded border-gray-300 dark:border-gray-600
                           dark:bg-gray-700 dark:text-gray-200">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Product Name
            </label>
            <input type="text" name="name"
                   value="{{ old('name', $product->name) }}"
                   class="w-full mt-1 rounded border-gray-300 dark:border-gray-600
                          dark:bg-gray-700 dark:text-gray-200">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Price
            </label>
            <input type="text" name="price"
                   value="{{ old('price', $product->price) }}"
                   class="w-full mt-1 rounded border-gray-300 dark:border-gray-600
                          dark:bg-gray-700 dark:text-gray-200">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Description
            </label>
            <textarea name="description" rows="4"
                class="w-full mt-1 rounded border-gray-300 dark:border-gray-600
                       dark:bg-gray-700 dark:text-gray-200">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Product Image
            </label>

            @if ($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="w-16 h-16 object-cover rounded mb-2">
            @endif

            <input type="file" name="image"
                   class="w-full text-sm text-gray-600 dark:text-gray-300">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Status
            </label>
            <select name="is_active"
                    class="w-full mt-1 rounded border-gray-300 dark:border-gray-600
                           dark:bg-gray-700 dark:text-gray-200">
                <option value="1" {{ $product->is_active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit"
                class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                Update Product
            </button>

            <a href="{{ route('dashboard') }}"
               style="
  padding: 0.25rem 0.75rem;
  font-size: 0.875rem;
  border-radius: 0.375rem;
  background-color: #fee2e2;
  color: #b91c1c;
">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection
