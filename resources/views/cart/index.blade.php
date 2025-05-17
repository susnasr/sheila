<!-- resources/views/cart/index.blade.php -->
<div class="card mb-3">
    <div class="card-header">Apply Coupon</div>
    <div class="card-body">
        <form action="{{ route('cart.apply-coupon') }}" method="POST" class="form-inline">
            @csrf
            <div class="input-group">
                <input type="text" name="code" class="form-control" placeholder="Coupon code">
                <button type="submit" class="btn btn-primary">Apply</button>
            </div>
        </form>

        @if(session('coupon_code'))
            <div class="mt-2">
                Applied coupon: {{ session('coupon_code') }}
                <a href="{{ route('cart.remove-coupon') }}" class="text-danger">Remove</a>
            </div>
        @endif
    </div>
</div>
