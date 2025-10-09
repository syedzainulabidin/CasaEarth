@extends('dashboard.partials.layout')
@section('title', 'Therapists')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Available Therapists</h3>

        @if ($therapists->isEmpty())
            <div class="alert alert-info">
                No therapists available at the moment.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Slots</th>
                        <th>Days</th>
                        <th>Charges</th>
                        <th>Specialization</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($therapists as $therapist)
                        <tr>
                            <td>{{ $therapist->id }}</td>
                            <td>{{ $therapist->name }}</td>
                            <td>{{ $therapist->email }}</td>

                            {{-- Decode slots JSON --}}
                            <td>
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
                                                $startFormatted = $endFormatted = 'Invalid Time';
                                            }
                                        @endphp

                                        <span class="badge bg-primary">{{ $startFormatted }} - {{ $endFormatted }}</span>
                                    @endforeach
                                @else
                                    <span class="badge bg-secondary">No slots available</span>
                                @endif
                            </td>

                            {{-- Decode days JSON --}}
                            <td>
                                @foreach (json_decode($therapist->days, true) as $day)
                                    <span class="badge bg-warning text-dark">{{ $day }}</span>
                                @endforeach
                            </td>
                            <td>{{ $therapist->charges }}</td>

                            <td>{{ $therapist->specialization }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
