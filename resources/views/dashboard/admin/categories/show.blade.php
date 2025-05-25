@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Category Show</h2>

    <div class="card">
        <div class="card-header">
            <h4>{{ $category->name }}</h4>
        </div>
    </div>

    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
