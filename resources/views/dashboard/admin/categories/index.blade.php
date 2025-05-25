@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Category List</h2>
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-success mb-3">Add Category</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Courses IN Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        {{-- @foreach($category->courses as $course)
                            <li>{{ $course->name }}</li>
                        @endforeach --}}
                        <a href="{{ route('dashboard.courses.index', ['category_id' => $category->id]) }}">
                            {{ $category->courses->count() }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('dashboard.categories.show', $category->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
