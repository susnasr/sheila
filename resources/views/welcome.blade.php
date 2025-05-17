<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SHEILA - Official outfit site of Exalters</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
            url('https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .brand-font {
            font-family: 'Playfair Display', serif;
            letter-spacing: 2px;
        }
        .body-font {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body class="body-font">
<!-- Navigation -->
<nav class="container mx-auto px-6 py-4">
    <div class="flex justify-between items-center">
        <div class="text-2xl font-bold brand-font">SHEILA</div>
        <div class="flex space-x-4">
            <a href="{{ route('login') }}" class="px-4 py-2">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-black text-white rounded">Register</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero">
    <div class="max-w-2xl px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 brand-font">Unseen outfits for unseen forces</h1>
        <p class="text-xl mb-8">Discover our curated collection of high-quality, stylish apparel</p>
        <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 bg-white text-black font-semibold rounded hover:bg-gray-100 transition">
            Shop Now
        </a>
    </div>
</div>

<!-- Features Section -->
<div class="container mx-auto px-6 py-16">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="p-6">
            <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-xl font-semibold mb-2">Free Shipping</h3>
            <p class="text-gray-600">On all orders over $50</p>
        </div>
        <div class="p-6">
            <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <h3 class="text-xl font-semibold mb-2">Easy Returns</h3>
            <p class="text-gray-600">30-day return policy</p>
        </div>
        <div class="p-6">
            <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h3 class="text-xl font-semibold mb-2">Secure Payment</h3>
            <p class="text-gray-600">100% secure checkout</p>
        </div>
    </div>
</div>

@include('layouts.footer')
</body>
</html>
