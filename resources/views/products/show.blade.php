<div class="row">
    <div class="col-md-6">
        @if($product->images)
            <!-- Main Carousel -->
            <div id="productCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($product->images as $key => $image)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Thumbnail Grid -->
            <div class="grid grid-cols-3 gap-2 mt-3">
                @foreach($product->images as $key => $image)
                    <div class="aspect-w-1 aspect-h-1 cursor-pointer" onclick="showSlide({{ $key }})">
                        <img src="{{ asset('storage/' . $image) }}"
                             class="object-cover border {{ $key === 0 ? 'border-primary' : 'border-transparent' }}"
                             alt="{{ $product->name }} thumbnail">
                    </div>
                @endforeach
            </div>
        @elseif($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
        @else
            <div class="bg-light text-center p-5">
                No image available
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {{-- Product variants and details --}}
        @if($product->variants->count())
            <div class="mb-3">
                @foreach($product->variants->groupBy(function($item) {
                    return $item->options->first()->variation->name;
                }) as $variationName => $variants)
                    <div class="form-group">
                        <label>{{ ucfirst($variationName) }}</label>
                        <select name="{{ $variationName }}" class="form-control variant-selector">
                            @foreach($variants as $variant)
                                <option value="{{ $variant->id }}"
                                        data-price="{{ $variant->price ?? $product->price }}"
                                        data-stock="{{ $variant->stock }}">
                                    {{ $variant->options->pluck('value')->join(', ') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endforeach

                <div class="mb-3">
                    <strong>Price:</strong> <span id="variant-price">${{ number_format($product->price, 2) }}</span>
                </div>
                <div class="mb-3">
                    <strong>Availability:</strong> <span id="variant-stock">{{ $product->stock }} in stock</span>
                </div>
            </div>
        @endif
    </div>
</div>

@auth
    <form action="{{ route('wishlist.store', $product) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-outline-secondary">
            <i class="far fa-heart"></i> Add to Wishlist
        </button>
    </form>
@endauth

<div class="mt-5">
    <h4>Reviews</h4>

    @if($product->reviews->count())
        <div class="mb-3">
            Average Rating: {{ number_format($product->averageRating(), 1) }} / 5
        </div>

        @foreach($product->reviews as $review)
            <div class="card mb-2">
                <div class="card-body">
                    <h5>{{ $review->user->name }}</h5>
                    <div class="text-warning">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <p>{{ $review->comment }}</p>
                    <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                </div>
            </div>
        @endforeach
    @else
        <p>No reviews yet.</p>
    @endif

    @auth
        <div class="card mt-4">
            <div class="card-header">Add Your Review</div>
            <div class="card-body">
                <form action="{{ route('reviews.store', $product) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Rating</label>
                        <select name="rating" class="form-control" required>
                            <option value="">Select Rating</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea name="comment" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        </div>
    @else
        <p><a href="{{ route('login') }}">Login</a> to leave a review.</p>
    @endauth
</div>

@push('scripts')
    <script>
        // Variant selection
        document.querySelectorAll('.variant-selector').forEach(select => {
            select.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                document.getElementById('variant-price').textContent = '$' + parseFloat(selectedOption.dataset.price).toFixed(2);
                document.getElementById('variant-stock').textContent = selectedOption.dataset.stock + ' in stock';
            });
        });

        // Thumbnail navigation
        function showSlide(index) {
            const carousel = new bootstrap.Carousel(document.getElementById('productCarousel'));
            carousel.to(index);

            // Update active thumbnail borders
            document.querySelectorAll('.aspect-w-1 img').forEach((img, i) => {
                img.classList.toggle('border-primary', i === index);
                img.classList.toggle('border-transparent', i !== index);
            });
        }
    </script>
@endpush
