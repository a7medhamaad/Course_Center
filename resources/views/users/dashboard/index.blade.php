@extends('layouts.app')

@section('title', 'User Dashboard')

@section('header')
    Welcome, {{ auth()->user()->name }}
@endsection

@section('content')
<div class="row dashboard-links g-4">
    <div class="col-md-4">
        <a href="{{ route('users.courses.index') }}" class="card">
            <i class="bi bi-journal-bookmark-fill"></i> Show All Courses
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('users.courses.my') }}" class="card">
            <i class="bi bi-collection-play-fill"></i> My Courses
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('users.profile.show') }}" class="card">
            <i class="bi bi-gear-fill"></i> Settings / Edit Profile
        </a>
    </div>
</div>
@endsection
