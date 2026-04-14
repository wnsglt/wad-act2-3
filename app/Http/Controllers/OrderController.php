<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Profile;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $orders = Order::with('profile.user', 'products')->oldest()->get();
        } else {
            $orders = Order::with('profile.user', 'products')
                ->whereHas('profile', fn($q) => $q->where('user_id', $user->id))
                ->oldest()
                ->get();
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $products = Product::all();
        $profiles = Profile::with('user')->get();

        return view('orders.create', compact('products', 'profiles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'profile_id' => 'required|exists:profiles,id',
            'products'   => 'required|array|min:1',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
        ]);

        $profile = Profile::findOrFail($request->profile_id);

        $order = $profile->orders()->create([
            'order_name' => 'Order #' . (Order::max('id') + 1), // Fallback internal identifier
        ]);

        // Prepare sync data with quantities
        $syncData = [];
        foreach ($request->products as $productId) {
            $syncData[$productId] = [
                'quantity' => $request->quantities[$productId] ?? 1
            ];
        }

        $order->products()->sync($syncData);

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('profile.user', 'products');

        // Non-admins can only view their own orders
        if (!Auth::user()->isAdmin() && $order->profile->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->load('products');

        if (!Auth::user()->isAdmin() && $order->profile->user_id !== Auth::id()) {
            abort(403);
        }

        $products = Product::all();

        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'products'   => 'required|array|min:1',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
        ]);

        if (!Auth::user()->isAdmin() && $order->profile->user_id !== Auth::id()) {
            abort(403);
        }

        // Prepare sync data with quantities
        $syncData = [];
        foreach ($request->products as $productId) {
            $syncData[$productId] = [
                'quantity' => $request->quantities[$productId] ?? 1
            ];
        }

        $order->products()->sync($syncData);

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {

        if (!Auth::user()->isAdmin() && $order->profile->user_id !== Auth::id()) {
            abort(403);
        }

        $order->products()->detach();
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}
