@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Course List</h2>
    <a href="{{ route('dashboard.courses.create') }}" class="btn btn-success mb-3">Add New Course</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Course Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Video Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ Str::limit($course->description, 50) }}</td>
                    <td>{{ $course->price }} EGP</td>
                    <td>{{ $course->category->name }}</td>
                    <td><a href="{{ route('dashboard.video', $course->id) }}">Watch Video</a></td>
                    <td>
                        <a href="{{ route('dashboard.courses.show', $course->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('dashboard.courses.edit', $course->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('dashboard.courses.destroy', $course->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
