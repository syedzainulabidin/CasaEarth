@extends('partials.layout')

@section('title', 'Signup')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Sign Up</h2>

        <form action="{{ route('signup') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tier -->
            <div class="mb-3">
                <label for="tier" class="form-label">Choose a Tier</label>
                <select name="tier" id="tier" class="form-select @error('tier') is-invalid @enderror">
                    <option value="" disabled {{ old('tier') ? '' : 'selected' }}>Select your tier</option>

                    @foreach ($tiers as $tier)
                        <option value="{{ $tier->id }}" {{ old('tier') == $tier->id ? 'selected' : '' }}>
                            {{ ucfirst($tier->title) }}
                        </option>
                    @endforeach
                </select>

                @error('tier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- Payment Fields (Initially hidden) (Stripe) -->
            <div id="card-element" class="form-control"></div>
            <input type="hidden" name="stripeToken" id="stripe-token">


            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <!-- Submit -->

            <button type="button" class="btn btn-warning text-dark" onclick="createToken()">Generate Token</button>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
        <hr>
        <center>OR</center>
        <hr>
        <div class="mt-3 text-center">
            <a href="{{ route('google.redirect') }}" class="btn btn-danger w-100">
                <i class="fab fa-google me-2"></i> Sign up with Google
            </a>
        </div>


        {{-- <form method="POST" action="{{ route('stripe.payment') }}" id="stripe-form">
            @csrf
            <input type="hidden" name="stripeToken" id="stripe-token">
            <div id="card-element" class="form-control"></div>
        </form> --}}
        {{-- <div id="payment-fields" class="border rounded p-3 mb-3 d-none bg-light">
            <h5 class="mb-3">Payment Details</h5>

            <div class="mb-3">
                <label for="card_number" class="form-label">Card Number</label>
                <input type="text" name="card_number" class="form-control @error('card_number') is-invalid @enderror"
                    value="{{ old('card_number') }}">
                @error('card_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cvc" class="form-label">CVC</label>
                    <input type="text" name="cvc" class="form-control @error('cvc') is-invalid @enderror"
                        value="{{ old('cvc') }}">
                    @error('cvc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="expiry" class="form-label">Expiry Date</label>
                    <input type="text" name="expiry" class="form-control @error('expiry') is-invalid @enderror"
                        placeholder="MM/YY" value="{{ old('expiry') }}">
                    @error('expiry')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/clover/stripe.js"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        function createToken() {
            stripe.createToken(cardElement).then(function(result) {
                if (result.token) {
                    document.querySelector('#stripe-token').value = result.token.id;
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tierSelect = document.getElementById('tier');
            const paymentFields = document.getElementById('card-element');

            function togglePaymentFields() {
                const value = tierSelect.value;
                if (value == 1 || value === '') {
                    paymentFields.classList.add('d-none');
                } else {
                    paymentFields.classList.remove('d-none');
                }
            }

            tierSelect.addEventListener('change', togglePaymentFields);

            // Trigger on page load (in case of old input)
            togglePaymentFields();
        });
    </script>
@endpush
