@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Edit Category</h2>

    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
        </div>

        
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
