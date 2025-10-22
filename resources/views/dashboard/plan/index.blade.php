@extends('dashboard.partials.layout')
@section('title', 'My Plan')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center fw-bold">Manage Your Plan</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row justify-content-center">
            {{-- @php
                $currentPrice = \App\Models\Tier::findorFail($myTier)->price;
            @endphp --}}

            @foreach ($tiers as $tier)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 h-100 ">
                        <div class="card-body text-center d-flex flex-column justify-content-between">

                            {{-- Tier Info --}}
                            <div>
                                <h4 class="fw-bold mb-2">{{ ucfirst($tier->title) }}</h4>
                                <h2 class="fw-bold mb-3">${{ number_format($tier->price, 2) }}</h2>

                                {{-- Features --}}
                                @php
                                    $features = $tier->includes;

                                    if (is_string($features)) {
                                        $features = json_decode($features, true);
                                    }
                                @endphp

                                <ul class="list-unstyled mb-4">
                                    @foreach ($features as $feature)
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle text-success me-2"></i>{{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>


                            </div>

                            {{-- Action Buttons --}}
                            <div>
                                @if ($tier->id == ucfirst($myTier->id))
                                    <button class="btn btn-secondary w-100 fw-semibold" disabled>
                                        <i class="bi bi-star-fill me-1"></i> Current Plan
                                    </button>
                                @elseif ($tier->price > $myTier->price)
                                    <a href="{{ route('plan.show', lcfirst($tier->title)) }}"
                                        class="btn btn-dark w-100 fw-semibold">
                                        Upgrade to {{ ucfirst($tier->title) }}
                                    </a>
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
