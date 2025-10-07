@extends('partials.layout')

@section('title', 'Pricing')

@section('content')
    <div class="min-h-screen bg-gray-50 py-16 px-6">
        <div class="max-w-6xl mx-auto text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-3">Our Pricing Plans</h1>
            <p class="text-gray-600 text-lg">Choose the plan that fits your needs best.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @forelse ($tiers as $tier)
                <div class="bg-white rounded-2xl shadow-md p-8 border hover:shadow-lg transition">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $tier->title }}</h2>
                    <p class="text-gray-500 mb-4">{{ ucfirst($tier->type ?? '') }}</p>

                    <div class="text-4xl font-extrabold text-indigo-600 mb-6">
                        {{ $tier->price == 0 ? 'Free' : '$' . number_format($tier->price, 2) }}
                    </div>

                    @php
                        $includes = is_string($tier->includes) ? json_decode($tier->includes, true) : $tier->includes;
                    @endphp

                    @if (!empty($includes))
                        <ul class="text-left space-y-2 mb-8">
                            @foreach ($includes as $item)
                                <li class="flex items-center gap-2 text-gray-700">
                                   
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <a href="#"
                        class="block w-full text-center py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition">
                        Choose Plan
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">
                    No tiers available yet.
                </div>
            @endforelse
        </div>
    </div>
@endsection
