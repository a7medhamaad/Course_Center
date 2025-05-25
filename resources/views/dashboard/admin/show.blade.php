@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>User Details</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $admin->name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
        </div>
    </div>

    <a href="{{ route('dashboard.admin.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
