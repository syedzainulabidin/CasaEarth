@extends('dashboard.partials.layout')
@section('title', 'All Appointments')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>All Guides</h3>
        </div>

        @if ($guides->isEmpty())
            <div class="alert alert-info">
                No guide have been uploaded yet.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>S.no</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Tier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guides as $guide)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $guide->title }}
                            </td>
                            <td>
                                {{ $guide->description }}
                            </td>
                            <td>
                                {{ $guide->tier }}
                            </td>
                            <td>
                                @php
                                    $canDownload = match ($guide->tier) {
                                        'free' => in_array(strtolower(Auth::user()->tier->title), [
                                            'free',
                                            'premium',
                                            'advance',
                                        ]),
                                        'premium' => in_array(strtolower(Auth::user()->tier->title), [
                                            'premium',
                                            'advance',
                                        ]),
                                        'advance' => strtolower(Auth::user()->tier->title) === 'advance',
                                        default => false,
                                    };
                                @endphp
                                @if ($canDownload)
                                    <a href="{{ route('guide.download', $guide->id) }}" target="_blank"
                                        class="btn btn-sm btn-outline-success">
                                        Download
                                    </a>
                                @else
                                    <span class="text-danger">Restricted</span>
                                @endif
                                @php
                                    $canView = match ($guide->tier) {
                                        'free' => in_array(strtolower(Auth::user()->tier->title), [
                                            'free',
                                            'premium',
                                            'advance',
                                        ]),
                                        'premium' => in_array(strtolower(Auth::user()->tier->title), [
                                            'premium',
                                            'advance',
                                        ]),
                                        'advance' => strtolower(Auth::user()->tier->title) === 'advance',
                                        default => false,
                                    };
                                @endphp

                                @if ($canView)
                                    <a href="{{ route('guide.view', $guide->id) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        View
                                    </a>
                                @else
                                @endif
                                @php
                                    $canRemove = match ($guide->tier) {
                                        'free' => in_array(strtolower(Auth::user()->tier->title), [
                                            'free',
                                            'premium',
                                            'advance',
                                        ]),
                                        'premium' => in_array(strtolower(Auth::user()->tier->title), [
                                            'premium',
                                            'advance',
                                        ]),
                                        'advance' => strtolower(Auth::user()->tier->title) === 'advance',
                                        default => false,
                                    };
                                @endphp
                                @if ($canRemove)
                                    <a href="{{ route('guide.view', $guide->id) }}" class="btn btn-sm btn-danger">
                                        Remove
                                    </a>
                                @else
                                    <span class="text-danger">Restricted</span>
                                @endif
                            </td>



                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
