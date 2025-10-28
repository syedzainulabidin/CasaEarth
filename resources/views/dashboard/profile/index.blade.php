@extends('dashboard.partials.layout')
@section('title', 'Profile')

@section('content')
    <div class="container py-5" style="max-width: 600px;">
        <h2 class="mb-4 text-center fw-bold">My Profile</h2>


        {{-- Success message --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Update Profile Form --}}
        <form action="{{ route('profile.update', $user->id) }}" method="POST" class="mb-5">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label
                    class="form-label fw-semibold">{{ $user->google_id ? 'Connected with Google ' : 'Registered Email' }}</label>
                <input type="text" name="none" class="form-control" value="{{ old('email', $user->email) }}" disabled>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">New Password</label>
                <input type="password" name="password" class="form-control"
                    placeholder="Leave empty to keep current password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control"
                    placeholder="Re-enter new password">
            </div>

            <button type="submit" class="btn btn-dark w-100 fw-semibold">Save Changes</button>
        </form>


        <div class={{ Auth::user()->role == 'admin' ? 'd-none' : 'd-block' }}>
            <hr class="my-5">

            <h2 class="mb-4 text-center fw-bold">My Plan</h2>
            <h4>
                <span>Purchased on
                    <span class="bg-dark text-white p-1 rounded">
                        @php
                            use App\Models\Plan;
                            $plan = Plan::where('user_id', Auth::id())->first();
                        @endphp

                        @if ($plan)
                            {{ $plan->updated_at->format('d/m/Y') }}
                        @else
                            No plan found.
                        @endif
                    </span>
                </span>
            </h4>
            <h4 class="pt-2">
                <span>
                    @php
                        use Carbon\Carbon;

                        $plan = Plan::where('user_id', Auth::id())->first();
                    @endphp

                    @if ($plan)
                        @php
                            // Calculate expiration date: 1 month after updated_at
                            $expiryDate = $plan->updated_at->copy()->addMonth();

                            // Calculate remaining full days (positive or negative)
                            $daysRemaining = Carbon::now()->startOfDay()->diffInDays($expiryDate->startOfDay(), false);

                            // Determine text with proper HTML
                            if ($daysRemaining > 0) {
                                $expiryText = "Expires in <span class='bg-dark text-white p-1 rounded'>{$daysRemaining} days</span>";
                            } elseif ($daysRemaining === 0) {
                                $expiryText = "Expiring <span class='bg-dark text-white p-1 rounded'>Today</span>";
                            } else {
                                $expiryText =
                                    "Expired <span class='bg-dark text-white p-1 rounded'>" .
                                    abs($daysRemaining) .
                                    ' days ago</span>';
                            }
                        @endphp

                        {!! $expiryText !!}
                    @else
                        No plan found.
                    @endif
                </span>
            </h4>



            <a href="{{ route('plan.index') }}"
                class="mb-4 d-flex text-decoration-none align-items-center justify-content-between bg-dark text-light p-2 rounded">
                <div class="plan fw-bold fs-1 d-inline ">
                    @php
                        echo Auth::user()->tier->title;
                    @endphp
                </div>
                <div class="plan fw-bold fs-1 d-inline ">
                    @php
                        echo "$" . Auth::user()->tier->price;
                    @endphp
                </div>
            </a>
        </div>
        {{-- Delete Account --}}
        <h4 class="text-danger fw-bold">Delete My Account</h4>
        <p class="text-muted">This action is permanent and cannot be undone.</p>

        <form action="{{ route('profile.destroy', $user->id) }}" method="POST" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="confirm_delete" id="confirm_delete">
                <label class="form-check-label" for="confirm_delete">
                    I understand that this will permanently delete my account.
                </label>
                @error('confirm_delete')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-danger w-100 fw-semibold">Delete My Account</button>
        </form>
    </div>

    <script>
        function confirmDelete() {
            const checkbox = document.getElementById('confirm_delete');
            if (!checkbox.checked) {
                alert('Please confirm before deleting your account.');
                return false;
            }
            return confirm('Are you sure you want to delete your account? This cannot be undone.');
        }
    </script>
@endsection
