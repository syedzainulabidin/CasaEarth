@extends('dashboard.partials.layout')
@section('title', 'My Plan')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center fw-bold">Manage Your Plan</h2>

        <div class="row justify-content-center">
            @php
                // Get the user's current tier from DB
$currentTier = \App\Models\Tier::where('title', $myTier)->first();
                $currentPrice = $currentTier->price ?? 0;
            @endphp

            @foreach ($tiers as $tier)
                <div class="col-md-4 mb-4">
                    <div
                        class="card shadow-sm border-0 h-100 
                    {{ $tier->title === $myTier ? 'border-primary border-3' : 'border-light' }}">
                        <div class="card-body text-center d-flex flex-column justify-content-between">

                            {{-- Tier Info --}}
                            <div>
                                <h4 class="fw-bold mb-2">{{ ucfirst($tier->title) }}</h4>
                                <h2 class="fw-bold mb-3">${{ number_format($tier->price, 2) }}</h2>

                                {{-- Features --}}
                                <ul class="list-unstyled mb-4">
                                    @foreach ($tier->includes ?? [] as $feature)
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle text-success me-2"></i>{{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- Action Buttons --}}
                            <div>
                                @if ($tier->title == ucfirst($myTier))
                                    <button class="btn btn-success w-100 fw-semibold" disabled>
                                        <i class="bi bi-star-fill me-1"></i> Current Plan
                                    </button>
                                @elseif ($tier->price > $currentPrice)
                                    <form action="" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100 fw-semibold">
                                            Upgrade to {{ ucfirst($tier->title) }}
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-outline-secondary w-100" disabled>
                                        Not Available
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Bootstrap icons (if not already included) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection
