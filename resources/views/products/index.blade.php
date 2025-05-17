<!-- resources/views/products/index.blade.php -->

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">Filters</div>
            <div class="card-body">
                <form method="GET" action="{{ route('products.index') }}">
                    <!-- Search -->
                    <div class="form-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                    </div>

                    <!-- Categories -->
                    <div class="form-group mb-3">
                        <label>Categories</label>
                        <select name="category" class="form-control">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="form-group mb-3">
                        <label>Price Range</label>
                        <div class="row">
                            <div class="col">
                                <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}">
                            </div>
                            <div class="col">
                                <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>
                        <div class="mt-2">
                            <input type="range" class="form-range" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                                   id="priceRange" value="{{ request('max_price') ?? $maxPrice }}">
                        </div>
                    </div>

                    <!-- Sorting -->
                    <div class="form-group mb-3">
                        <label>Sort By</label>
                        <select name="sort" class="form-control">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2">Reset</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    @include('products.partials.product-card', ['product' => $product])
                </div>
            @empty
                <div class="col-12">
                    <p>No products found.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</div>
