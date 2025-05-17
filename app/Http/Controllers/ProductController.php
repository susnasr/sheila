<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category')->where('is_active', true);

        // Search
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Category filter
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Price range
        $query->when($request->min_price, function($q) use ($request) {
            $q->where('price', '>=', $request->min_price);
        })->when($request->max_price, function($q) use ($request) {
            $q->where('price', '<=', $request->max_price);
        });

        // Sorting
        $sortOptions = [
            'price_asc' => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
            'newest' => ['created_at', 'desc'],
            'popular' => ['views', 'desc'],
        ];

        $sort = $request->get('sort', 'newest');
        $sortValue = $sortOptions[$sort] ?? $sortOptions['newest'];
        $query->orderBy(...$sortValue);

        $products = $query->paginate(12);
        $categories = Category::all();

        // Get min and max prices for filter range
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        return view('products.index', compact('products', 'categories', 'minPrice', 'maxPrice', 'sort'));
    }

    public function show(Product $product)
    {
        SEOMeta::setTitle($product->name . ' - Sheila Clothing');
        SEOMeta::setDescription(Str::limit(strip_tags($product->description), 160));
        SEOMeta::addKeyword(explode(' ', $product->name));

        OpenGraph::setTitle($product->name);
        OpenGraph::setDescription(Str::limit(strip_tags($product->description), 160));
        OpenGraph::addImage(asset('storage/' . $product->image));

        return view('products.show', compact('product'));
    }

    // Admin methods
    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    // Implement other methods (edit, update, destroy) similarly
}
