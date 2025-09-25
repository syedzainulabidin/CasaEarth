@extends('dashboard.partials.layout')
@section('title','Therapist')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">Therapists List</h3>
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Slots</th>
                    <th>Days</th>
                    <th>Specialization</th>
                    <th>Created At</th>
                    <th>Actions</th>
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
                    $startFormatted = \Carbon\Carbon::createFromFormat('H:i', trim($start))->format('h:i A');
                    $endFormatted   = \Carbon\Carbon::createFromFormat('H:i', trim($end))->format('h:i A');
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
                                    <span class="badge bg-info text-dark">{{ $day }}</span>
                                @endforeach
                            </td>

                        <td>{{ $therapist->specialization }}</td>
                        <td>{{ $therapist->created_at->format('Y-m-d') }}</td>

                        <td>
                            <a href="{{ route('therapist.edit', $therapist->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('therapist.destroy', $therapist->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
