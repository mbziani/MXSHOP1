<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || !auth()->user()->is_admin) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::where('is_admin', false)->count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalUsers', 'recentOrders'));
    }

    public function products()
    {
        $products = Product::with('category')->paginate(15);
        return view('admin.products', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.create-product', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required|string',
            'image' => 'nullable|url'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image ?? 'https://via.placeholder.com/400x400?text=Product',
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'size' => $request->size,
            'color' => $request->color
        ]);

        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }

    public function editProduct(Product $product)
    {
        $categories = Category::all();
        return view('admin.edit-product', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }

    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(20);
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }
}
