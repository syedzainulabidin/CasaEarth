@extends('partials.layout')

@section('title', 'Signup')

@section('content')
    <div class="container py-5" style="margin-top: 70px">
        <h2 class="mb-4">Sign Up</h2>

        <form action="{{ route('signup') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-1">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-1">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tier -->
            <div class="mb-1">
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
            <div class="mb-1">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div class="mb-1">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <!-- Submit -->

            {{-- <button type="button" class="btn btn-warning text-dark" onclick="createToken()">Generate Token</button> --}}
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
        <hr>
        <center>OR</center>
        <hr>
        <div class="mt-3 text-center">
            <a href="{{ route('google.redirect') }}" class="btn btn-dark w-100">
                <i class="fab fa-google me-2"></i> Sign up with Google
            </a>
        </div>
        <a href="{{ route('login-form') }}" class="w-100 btn text-dark">Already have an Account ?</a>
    </div>
@endsection

@push('scripts')
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const tierSelect = document.getElementById('tier');
            const paymentFields = document.getElementById('card-element');
            const stripeTokenInput = document.getElementById('stripe-token');

            // Handle tier change
            function togglePaymentFields() {
                const selectedLabel = tierSelect.options[tierSelect.selectedIndex].label;
                if (!selectedLabel || selectedLabel === 'Select your tier' || selectedLabel === 'Free') {
                    paymentFields.classList.add('d-none');
                } else {
                    paymentFields.classList.remove('d-none');
                }
            }

            tierSelect.addEventListener('change', togglePaymentFields);
            togglePaymentFields();

            // Intercept form submission
            form.addEventListener('submit', function(e) {
                const selectedLabel = tierSelect.options[tierSelect.selectedIndex].label;

                // If payment is needed, prevent form submission and get token
                if (selectedLabel !== 'Free' && selectedLabel !== 'Select your tier') {
                    e.preventDefault();

                    stripe.createToken(cardElement).then(function(result) {
                        if (result.error) {
                            alert(result.error.message);
                        } else {
                            stripeTokenInput.value = result.token.id;
                            form.submit(); // Now submit the form
                        }
                    });
                }
            });
        });
    </script>
@endpush
