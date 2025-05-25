@extends('layouts.app')

@section('title', 'Welcome - All Courses')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4 text-primary mb-3">Welcome to Our Courses Platform</h1>
        <p class="lead">Browse and buy the best courses to level up your skills.</p>

        @guest
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        @else
            <a href="{{ route('users.profile.show') }}" class="btn btn-success me-2">Go to Your Profile</a>

            {{-- <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form> --}}
        @endguest
    </div>

    <h2 class="mb-4 text-center">Available Courses</h2>

    <div class="row g-4">
        @foreach($courses as $course)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded-4">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary fw-bold">{{ $course->title }}</h5>
                    <p class="card-text text-secondary flex-grow-1">{{ Str::limit($course->description, 100) }}</p>
                    <p class="fw-semibold fs-5 mb-3">{{ number_format($course->price, 2) }} EGP</p>

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-primary mt-auto">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login to Buy
                        </a>
                    @else
                        <a href="{{ route('users.courses.checkout', $course->id) }}" class="btn btn-success mt-auto">
                            <i class="bi bi-cart-plus me-2"></i> Buy Now
                        </a>
                    @endguest
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
