@extends('partials.layout')

@section('title', 'Pricing')

@section('content')
    <div class="pricing">
        <h1 data-aos="fade-up" data-aos-delay="200">Our Pricing Plans</h1>
        <p data-aos="fade-up" data-aos-delay="300">Choose the plan that fits your needs best.</p>
        <div class="pricing-container">
            @forelse ($tiers as $tier)
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="300">
                    <h2>{{ $tier->title }}</h2>
                    <h3>{{ ucfirst($tier->type ?? '') }}</h3>

                    <div class="price">
                        {{ $tier->price == 0 ? 'Free' : '$' . number_format($tier->price, 2) }}
                    </div>

                    @php
                        $includes = is_string($tier->includes) ? json_decode($tier->includes, true) : $tier->includes;
                    @endphp

                    @if (!empty($includes))
                        <ul>
                            @foreach ($includes as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <a href="{{ route('signup-form') }}"><button type="button">Choose Plan</button></a>
                </div>
            @empty
                <div class="no-tiers" data-aos="fade-up" data-aos-delay="200">
                    No tiers available yet.
                </div>
            @endforelse
        </div>
    </div>
@endsection
