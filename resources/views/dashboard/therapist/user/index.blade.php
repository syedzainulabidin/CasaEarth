@extends('dashboard.partials.layout')
@section('title', 'Therapists')

@section('content')
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-900 py-8 text-center">Available Therapists</h2>

        @if ($therapists->isEmpty())
            <div class="text-center text-gray-600 bg-white shadow-sm rounded-lg p-6 border border-gray-200">
                No therapists available at the moment.
            </div>
        @else
            <div class="flex gap-6 flex-wrap">
                @foreach ($therapists as $therapist)
                    <div class="w-[320px] grow p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <h5 class="mb-2 text-2xl bg-black text-white rounded p-3 font-bold tracking-tight">
                            {{ $therapist->name }}
                        </h5>

                        <p class="mb-3 text-gray-700">
                            <strong>Email:</strong> {{ $therapist->email }}
                        </p>

                        <div class="mb-3">
                            <strong class="text-gray-800">Slots:</strong>
                            <div class="flex flex-wrap gap-2 mt-1">
                                @if (!empty($therapist->slots))
                                    @foreach (json_decode($therapist->slots, true) as $slot)
                                        @php
                                            try {
                                                [$start, $end] = explode('-', $slot);
                                                $startFormatted = \Carbon\Carbon::createFromFormat(
                                                    'H:i',
                                                    trim($start),
                                                )->format('h:i A');
                                                $endFormatted = \Carbon\Carbon::createFromFormat(
                                                    'H:i',
                                                    trim($end),
                                                )->format('h:i A');
                                            } catch (\Exception $e) {
                                                $startFormatted = $endFormatted = 'Invalid';
                                            }
                                        @endphp
                                        <span class="px-2 py-1 text-sm bg-black text-white rounded-md">
                                            {{ $startFormatted }} - {{ $endFormatted }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="px-2 py-1 text-sm bg-gray-100 text-gray-500 rounded-md">No slots
                                        available</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <strong class="text-gray-800">Days:</strong>
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach (json_decode($therapist->days, true) as $day)
                                    <span
                                        class="px-2 py-1 text-sm bg-black text-white rounded-md">{{ $day }}</span>
                                @endforeach
                            </div>
                        </div>
                        <p class="text-gray-700 mb-3">
                            <strong>Specialization:</strong> {{ $therapist->specialization }}
                        </p>

                        <p
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            ${{ $therapist->charges }}

                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
