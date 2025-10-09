@extends('dashboard.partials.layout')
@section('title', 'Plan - ' . $tier->title)

@section('content')
    <div class="max-w-4xl mx-auto py-12">
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800">{{ $tier->title }} Plan</h1>
            <p class="text-lg text-gray-500 mt-2">Upgrade your experience and unlock premium benefits</p>
        </div>

        {{-- Plan Card --}}
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
            <div class="p-8 flex flex-col md:flex-row md:items-center md:justify-between">
                {{-- Price Section --}}
                <div>
                    <p class="text-5xl font-extrabold text-gray-900">${{ $tier->price }}</p>
                    <p class="text-sm text-gray-500 mt-1">per month</p>
                </div>

            </div>

            <div class="border-t border-gray-200 px-8 py-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">What’s included</h2>
                <ul class="space-y-3 text-gray-700">
                    @foreach ($tier->includes as $item)
                        <li class="flex items-start">

                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <form action="{{ route('plan.upgrade') }}" method="POST" id="payment-form">
            @csrf
            <div id="card-element" class="form-control"></div>
            <input type="hidden" name="stripeToken" id="stripe-token">
            <input type="hidden" name="plan" value="{{ $tier->title }}">
            <button type="submit" class="btn btn-primary">Buy {{ $tier->title }}</button>
        </form>
    </div>

@endsection
@push('scripts')
    <script src="https://js.stripe.com/clover/stripe.js"></script>

    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('#payment-form');
            const paymentFields = document.getElementById('card-element');
            const stripeTokenInput = document.getElementById('stripe-token');

            // Intercept form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                stripe.createToken(cardElement).then(function(result) {
                    if (result.error) {
                        alert(result.error.message);
                    } else {
                        stripeTokenInput.value = result.token.id;
                        form.submit();
                    }
                });

            });
        });
    </script>
@endpush
