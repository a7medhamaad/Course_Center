@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary">Edit Profile</h2>

    <form action="{{ route('users.profile.update') }}" method="POST" class="card shadow-sm p-4 mx-auto" style="max-width: 600px;">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Update Profile
            </button>
        </div>
    </form>
</div>
@endsection
