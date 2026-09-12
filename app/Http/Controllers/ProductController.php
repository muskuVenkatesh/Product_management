<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the products along with dashboard analytics.
     */
    public function index(Request $request): View
    {
        // Global Analytics Metrics
        $totalProducts = Product::count();
        $totalQuantity = Product::sum('quantity');
        $totalValue = Product::selectRaw('SUM(price * quantity) as total_val')->value('total_val') ?? 0;
        $totalCategories = Product::distinct('category')->whereNotNull('category')->count('category');
        $categories = Product::distinct()->pluck('category')->filter()->sort()->values();

        // Product Query Filtering
        $query = Product::query();

        if ($request->filled('search')) {
            $searchTerm = trim($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('category', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->paginate(9)->withQueryString();

        return view('products.index', compact(
            'products',
            'totalProducts',
            'totalQuantity',
            'totalValue',
            'totalCategories',
            'categories'
        ));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $existingCategories = Product::distinct()->pluck('category')->filter()->sort()->values();

        return view('products.create', compact('existingCategories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', "Product '{$product->name}' created successfully!");
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $existingCategories = Product::distinct()->pluck('category')->filter()->sort()->values();

        return view('products.edit', compact('product', 'existingCategories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old file if it exists on public disk
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.show', $product)
            ->with('success', "Product '{$product->name}' updated successfully!");
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $productName = $product->name;

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', "Product '{$productName}' deleted successfully!");
    }
}
