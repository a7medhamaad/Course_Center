@extends('layouts.app')

@section('title', 'All Courses')

@section('header', 'All Courses')

@section('content')
<div class="container mt-4">
    <div class="row g-4">
        @foreach($courses as $course)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded-4">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary fw-bold">{{ $course->title }}</h5>
                    <p class="card-text text-secondary flex-grow-1">{{ Str::limit($course->description, 120) }}</p>
                    <p class="fw-semibold fs-5 mb-3">{{ number_format($course->price, 2) }} EGP</p>

                    @auth
                        @if(in_array($course->id, $purchasedCourseIds))
                            <button class="btn btn-secondary mt-auto" disabled>
                                <i class="bi bi-check-circle me-2"></i> Already Purchased
                            </button>
                        @else
                            <a href="{{ route('users.courses.checkout', $course->id) }}" class="btn btn-success mt-auto">
                                <i class="bi bi-cart-plus me-2"></i> Buy Now
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary mt-auto">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login to Buy
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
