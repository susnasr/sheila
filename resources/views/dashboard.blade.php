<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('My Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <!-- Orders Card -->
                        <div class="p-6 border rounded-lg dark:border-gray-700">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium dark:text-gray-200">My Orders</h3>
                                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                                        {{ $orderCount ?? 0 }} {{ Str::plural('order', $orderCount ?? 0) }}
                                    </p>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{ $pendingOrders ?? 0 }} pending
                                </span>
                            </div>
                            <a href="{{ route('orders.index') }}" class="inline-block mt-4 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                View All →
                            </a>
                        </div>

                        <!-- Wishlist Card -->
                        <div class="p-6 border rounded-lg dark:border-gray-700">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium dark:text-gray-200">Wishlist</h3>
                                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                                        {{ $wishlistCount ?? 0 }} {{ Str::plural('item', $wishlistCount ?? 0) }}
                                    </p>
                                </div>
                                <span class="bg-pink-100 text-pink-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300">
                                    {{ $wishlistOnSale ?? 0 }} on sale
                                </span>
                            </div>
                            <a href="{{ route('wishlist.index') }}" class="inline-block mt-4 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                View Wishlist →
                            </a>
                        </div>

                        <!-- Account Card -->
                        <div class="p-6 border rounded-lg dark:border-gray-700">
                            <h3 class="text-lg font-medium dark:text-gray-200">Account Details</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                Member since {{ auth()->user()->created_at->format('M Y') }}
                            </p>
                            <a href="{{ route('profile.show') }}" class="inline-block mt-4 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                Edit Profile →
                            </a>
                        </div>
                    </div>

                    <!-- Quick Actions Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium mb-4 dark:text-gray-200">Quick Actions</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <a href="{{ route('products.index') }}" class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow text-center hover:shadow-md transition border border-gray-200 dark:border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-blue-600 dark:text-blue-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <p class="text-sm font-medium dark:text-gray-300">Continue Shopping</p>
                            </a>
                            <a href="{{ route('cart.index') }}" class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow text-center hover:shadow-md transition border border-gray-200 dark:border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-green-600 dark:text-green-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <p class="text-sm font-medium dark:text-gray-300">View Cart</p>
                            </a>
                            <a href="{{ route('orders.index') }}" class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow text-center hover:shadow-md transition border border-gray-200 dark:border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-purple-600 dark:text-purple-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <p class="text-sm font-medium dark:text-gray-300">Track Orders</p>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow text-center hover:shadow-md transition border border-gray-200 dark:border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-yellow-600 dark:text-yellow-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-sm font-medium dark:text-gray-300">Account Settings</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
