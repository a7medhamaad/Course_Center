@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Add Category</h2>

    <form action="{{ route('dashboard.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
