<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('dashboard', [
            'orderCount' => $user->orders()->count(),
            'pendingOrders' => $user->orders()->where('status', 'pending')->count(),
            'wishlistCount' => $user->wishlist()->count(),
            'wishlistOnSale' => $user->wishlist()->whereHas('product', function($q) {
                $q->where('discount_price', '>', 0);
            })->count(),
            'recentActivities' => $this->getRecentActivities($user)
        ]);
    }

    private function getRecentActivities($user)
    {
        $activities = [];

        // Recent orders
        foreach ($user->orders()->latest()->take(2)->get() as $order) {
            $activities[] = [
                'type' => 'order',
                'message' => "Order #{$order->id} - {$order->status}",
                'time' => $order->created_at->diffForHumans()
            ];
        }

        // Recent wishlist items
        foreach ($user->wishlist()->latest()->take(2)->get() as $item) {
            $activities[] = [
                'type' => 'wishlist',
                'message' => "Added {$item->product->name} to wishlist",
                'time' => $item->created_at->diffForHumans()
            ];
        }

        // Sort by time
        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        return array_slice($activities, 0, 4);
    }
}
