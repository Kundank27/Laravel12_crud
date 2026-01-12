@extends('layouts.app')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-3">

    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
        Product List
    </h2>

    <div class="flex gap-2">

        <form method="GET" action="{{ route('dashboard') }}">
            <input type="text"
                   name="search"
                   value="{{ $search ?? '' }}"
                   placeholder="Search product or category..."
                   class="px-3 py-2 rounded border border-gray-300
                          dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
        </form>

    </div>

</div>


@if ($products->count())
<div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded">
    <table class="w-full table-fixed border border-gray-200 dark:border-gray-700">
        <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
                <th class="w-12 px-4 py-2 text-left text-gray-700 dark:text-gray-200">#</th>
                <th class="w-20 px-4 py-2 text-left text-gray-700 dark:text-gray-200">Image</th>
                <th class="w-1/4 px-4 py-2 text-left text-gray-700 dark:text-gray-200">Name</th>
                <th class="w-1/5 px-4 py-2 text-left text-gray-700 dark:text-gray-200">Category</th>
                <th class="w-24 px-4 py-2 text-left text-gray-700 dark:text-gray-200">Price</th>
                <th class="w-28 px-4 py-2 text-left text-gray-700 dark:text-gray-200">Status</th>
                <th class="w-28 px-4 py-2 text-left text-gray-700 dark:text-gray-200">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($products as $product)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-4 py-2 text-gray-800 dark:text-gray-200">
                    {{ $loop->iteration }}
                </td>

                <td class="px-4 py-2">
                    @if ($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="w-10 h-10 object-cover rounded">
                    @else
                        <span class="text-gray-500 dark:text-gray-400">N/A</span>
                    @endif
                </td>

                        <td class="px-4 py-2 text-gray-800 dark:text-gray-200">
                              {{ \Illuminate\Support\Str::words($product->name, 10, '...') }}
                         </td>

                <td class="px-4 py-2 text-gray-800 dark:text-gray-200">
                    {{ $product->category->name ?? 'N/A' }}
                </td>

                <td class="px-4 py-2 text-gray-800 dark:text-gray-200">
                    ₹ {{ $product->price }}
                </td>

                <td class="px-4 py-2">
                    @if ($product->is_active)
                        <span class="px-3 py-1 text-sm rounded bg-blue-100 text-blue-700
                              dark:bg-blue-800 dark:text-blue-200 hover:opacity-80">
                            Active
                        </span>
                    @else
                        <span class="px-3 py-1 text-sm rounded bg-blue-100 text-blue-700
                              dark:bg-blue-800 dark:text-blue-200 hover:opacity-80">
                            Inactive
                        </span>
                    @endif
                </td>
                <td class="px-4 py-2 flex gap-2">
                    
                    <a href="{{ route('products.edit', $product->id) }}"
                       class="px-3 py-1 text-sm rounded bg-blue-100 text-blue-700
                              dark:bg-blue-800 dark:text-blue-200 hover:opacity-80">
                                                     Edit
                    </a>
                
                    <form action="{{ route('products.destroy', $product->id) }}"
                          method="POST"
                                 onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                    
                        <button type="submit"
                                style="
                                      padding: 0.25rem 0.75rem;
                                      font-size: 0.875rem;
                                      border-radius: 0.375rem;
                                      background-color: #fee2e2;
                                      color: #b91c1c;
                                    ">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $products->links() }}
</div>

@else
<p class="text-gray-600 dark:text-gray-400">
    No products found.
</p>
@endif

@endsection
