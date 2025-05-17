<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $discount = 0;
        $discountCode = session('coupon_code');

        if ($discountCode) {
            $coupon = Coupon::where('code', $discountCode)
                ->where('is_active', true)
                ->where('start_date', '<=', now())
                ->where('expires_at', '>=', now())
                ->first();

            if ($coupon) {
                if ($coupon->discount_type == 'percentage') {
                    $discount = $subtotal * ($coupon->value / 100);
                } else {
                    $discount = $coupon->value;
                }
            }
        }

        $total = $subtotal - $discount;

        return view('cart.index', compact('cartItems', 'subtotal', 'discount', 'total'));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $coupon = Coupon::where('code', $request->code)
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('expires_at', '>=', now())
            ->first();

        if (!$coupon) {
            return back()->with('error', 'Invalid or expired coupon code.');
        }

        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            return back()->with('error', 'This coupon has reached its usage limit.');
        }

        session(['coupon_code' => $coupon->code]);

        return back()->with('success', 'Coupon applied successfully!');
    }

    // Existing methods (store, update, destroy) remain unchanged
}
