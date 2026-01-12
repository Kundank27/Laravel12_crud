@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow rounded p-6">

    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">
        Add Category
    </h2>

    @if (session('success'))
        <div class="mb-3 text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <ul class="mb-3 text-red-600 dark:text-red-400 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Category Name
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="w-full mt-1 rounded border-gray-300 dark:border-gray-600
                          dark:bg-gray-700 dark:text-gray-200">
        </div>

        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Save Category
        </button>
    </form>

</div>

@endsection
