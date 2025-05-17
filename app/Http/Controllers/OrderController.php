<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusNotification;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load('items.product'); // Eager load items with products
        return view('orders.show', compact('order'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:credit_card,paypal,bank_transfer',
        ]);

        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Calculate total with transaction
        $total = $cartItems->sum(function ($item) {
            if ($item->quantity > $item->product->stock) {
                throw new \Exception("Not enough stock for product: {$item->product->name}");
            }
            return $item->product->price * $item->quantity;
        });

        // Create order within transaction
        $order = \DB::transaction(function () use ($user, $request, $total, $cartItems) {
            $order = $user->orders()->create([
                'total_amount' => $total,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            $user->cartItems()->delete();
            return $order;
        });

        // Send notification
        $user->notify(new OrderStatusNotification($order));

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }

    // Future admin approval method (commented as in original)
    /*
    public function approve(Order $order) {
        $order->update(['status' => 'approved']);
        $order->user->notify(new OrderStatusNotification($order));
        return back()->with('success', 'Order approved.');
    }
    */
}
