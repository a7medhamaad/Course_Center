@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary">User Profile</h2>

    {{-- Flash Success Message --}}
    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    {{-- User Information --}}
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-light">
            <h5 class="mb-0">Personal Information</h5>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <a href="{{ route('users.profile.edit') }}" class="btn btn-outline-primary mt-3">
                <i class="bi bi-gear"></i> Edit Profile
            </a>
        </div>
    </div>

    {{-- Purchased Courses --}}
    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Purchased Courses</h5>
        </div>
        <div class="card-body">
            @forelse ($courses as $course)
            <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                <div>
                    <strong>{{ $course->title }}</strong>
                    <form action="{{ route('users.my-courses.destroy', $course->id) }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من إلغاء الاشتراك؟');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm ms-3">Unsubscribe</button>
                    </form>
                </div>
                <span class="badge bg-success">{{ number_format($course->price, 2) }} EGP</span>
            </div>
            @empty
            <p class="text-muted">You haven't purchased any courses yet.</p>
            @endforelse

            {{-- Button to Buy More Courses --}}
            <div class="text-center mt-4">
                <a href="{{ route('users.courses.index') }}" class="btn btn-outline-success">
                    <i class="bi bi-cart-plus"></i> Buy More Courses
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
