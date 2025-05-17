@if($order->tracking_number)
    <div class="card mb-3">
        <div class="card-header">Shipping Information</div>
        <div class="card-body">
            <p><strong>Carrier:</strong> {{ $order->carrier ?? 'Standard Shipping' }}</p>
            <p><strong>Tracking Number:</strong> {{ $order->tracking_number }}</p>
            @if($order->carrier)
                <a href="{{ $order->getTrackingUrl() }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    Track Package
                </a>
            @endif
        </div>
    </div>
@endif
