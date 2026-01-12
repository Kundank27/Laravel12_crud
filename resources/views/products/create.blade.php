@extends('layouts.app')

@section('content')


<div class="max-w-3xl mx-auto px-4 py-6">
    

    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">
        Add Product
    </h2>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 px-4 py-3">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data"
          class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 space-y-5">
        @csrf

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                Category
            </label>
            <select name="category_id"
                    class="w-full rounded-md border-gray-300 dark:border-gray-600
                           bg-white dark:bg-gray-700
                           text-gray-900 dark:text-gray-100
                           focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                Product Name
            </label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full rounded-md border-gray-300 dark:border-gray-600
                          bg-white dark:bg-gray-700
                          text-gray-900 dark:text-gray-100
                          focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                Price
            </label>
            <input type="text" name="price" value="{{ old('price') }}"
                   class="w-full rounded-md border-gray-300 dark:border-gray-600
                          bg-white dark:bg-gray-700
                          text-gray-900 dark:text-gray-100
                          focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                Description
            </label>
            <textarea name="description" rows="4"
                      class="w-full rounded-md border-gray-300 dark:border-gray-600
                             bg-white dark:bg-gray-700
                             text-gray-900 dark:text-gray-100
                             focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                Product Image
            </label>
            <input type="file" name="image"
                   class="block w-full text-sm text-gray-900 dark:text-gray-100
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-md file:border-0
                          file:text-sm file:font-semibold
                          file:bg-blue-100 dark:file:bg-blue-900
                          file:text-blue-700 dark:file:text-blue-200
                          hover:file:bg-blue-200 dark:hover:file:bg-blue-800">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                Status
            </label>
            <select name="is_active"
                    class="w-full rounded-md border-gray-300 dark:border-gray-600
                           bg-white dark:bg-gray-700
                           text-gray-900 dark:text-gray-100
                           focus:ring-blue-500 focus:border-blue-500">
                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="w-full md:w-auto px-6 py-2 rounded-md
                           bg-blue-600 hover:bg-blue-700
                           text-white font-semibold
                           focus:outline-none focus:ring-2 focus:ring-blue-500">
                Save Product
            </button>
        </div>

    </form>
</div>
@endsection
