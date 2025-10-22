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
                <label class="form-label fw-semibold">{{ $user->google_id ? "Connected with Google " : "Registered Email" }}</label>
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

        <hr class="my-5">

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
