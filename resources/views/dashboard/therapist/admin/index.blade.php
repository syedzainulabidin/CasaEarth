@extends('dashboard.partials.layout')
@section('title', 'Therapists')

@section('content')
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center py-8">
            <h2 class="text-3xl font-bold text-gray-900">Therapists List</h2>
            <a href="{{ route('therapist.create') }}"
                class="px-4 py-2 bg-black text-white !no-underline rounded-lg hover:bg-gray-800 transition-all">
                + Add Therapist
            </a>
        </div>

        @if ($therapists->isEmpty())
            <div class="text-center text-gray-600 bg-white shadow-sm rounded-lg p-6 border border-gray-200">
                No therapists available at the moment.
            </div>
        @else
            <div class="flex gap-6 flex-wrap">
                @foreach ($therapists as $therapist)
                    <div class="w-[320px] grow p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="text-2xl bg-black text-white rounded p-3 font-bold tracking-tight">
                                {{ $therapist->name }}
                            </h5>
                            <span class="text-sm text-gray-500">{{ $therapist->created_at->format('Y-m-d') }}</span>
                        </div>

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

                        <p class="text-gray-700 mb-4">
                            <strong>Charges:</strong> ${{ $therapist->charges }}
                        </p>

                        <div class="flex justify-end items-center mt-4 gap-2">
                            <a href="{{ route('therapist.edit', $therapist->id) }}"
                                class="px-3 py-2 bg-yellow-200 !text-yellow-600 !no-underline rounded-md hover:bg-yellow-300 text-sm">
                                Edit
                            </a>


                            <form action="{{ route('therapist.destroy', $therapist->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to remove {{ $therapist->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-2 bg-red-200 text-red-600 rounded hover:bg-red-300 text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
