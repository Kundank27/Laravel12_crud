<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
        //    ->oldest()
            ->paginate(12)
            ->withQueryString();

        return view('dashboard', compact('products', 'search'));
    }

    public function create()
    {
        $categories = Category::all();
        // return view('dashboard', compact('products', 'search'));
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active'   => 'required|boolean',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imagePath,
            'is_active'   => $request->is_active,
        ]);

        
        return redirect()->back()->with('success', 'Product added successfully!');
    }
    public function edit(Product $product)
    {
        $categories = Category::all();
        // return view('dashboard', compact('products', 'search'));
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active'   => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'is_active'   => $request->is_active,
            'image'       => $product->image,
        ]);
        // return redirect()->back()->with('success', 'Product added successfully!');
        return redirect()->route('dashboard')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfuly!');
    }
}
