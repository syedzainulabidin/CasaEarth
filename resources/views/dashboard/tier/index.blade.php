@extends('dashboard.partials.layout')
@section('title', 'Tiers')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Tier List</h3>
            <a href="{{ route('tier.create') }}" class="btn btn-dark">
                + Add Tier
            </a>
        </div>

        @if ($tiers->isEmpty())
            <div class="alert alert-info">No tiers available.</div>
        @else
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Includes</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tiers as $tier)
                        <tr>
                            <td>{{ $tier->id }}</td>
                            <td>{{ $tier->title }}</td>
                            <td>${{ number_format($tier->price, 2) }}</td>
                            <td>
                                @php
                                    $items = $tier->includes;

                                    if (is_string($items)) {
                                        $items = json_decode($items, true);
                                        if (is_string($items)) {
                                            $items = json_decode($items, true);
                                        }
                                    }
                                @endphp

                                @if (is_array($items))
                                    <ul class="mb-0">
                                        @foreach ($items as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <em>Invalid includes data</em>
                                @endif
                            </td>


                            <td>{{ $tier->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('tier.edit', $tier->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('tier.destroy', $tier->id) }}" method="POST" class="d-inline">
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
        @endif
    </div>
@endsection
