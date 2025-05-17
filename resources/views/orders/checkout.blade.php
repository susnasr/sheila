@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Checkout</h2>

        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
                    @csrf

                    <div class="form-group">
                        <label for="card-element">Credit or debit card</label>
                        <div id="card-element" class="form-control"></div>
                        <div id="card-errors" role="alert" class="text-danger"></div>
                    </div>

                    <div class="form-group">
                        <label for="shipping_address">Shipping Address</label>
                        <textarea name="shipping_address" class="form-control" required></textarea>
                    </div>

                    <button class="btn btn-primary">Submit Payment</button>
                </form>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Order Summary</div>
                    <div class="card-body">
                        @foreach($cartItems as $item)
                            <p>{{ $item->product->name }} x {{ $item->quantity }} - ${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        @endforeach
                        <hr>
                        <h5>Total: ${{ number_format($total, 2) }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const cardErrors = document.getElementById('card-errors');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                cardErrors.textContent = error.message;
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', paymentMethod.id);
                form.appendChild(hiddenInput);

                form.submit();
            }
        });
    </script>
@endsection
