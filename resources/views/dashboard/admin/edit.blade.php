@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.admin.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
        </div>

        <div class="form-group mt-4">
            <label>Courses:</label>
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="courses[]"
                                value="{{ $course->id }}"
                                {{ in_array($course->id, $userCourses) ? 'checked' : '' }}
                            >
                            <label class="form-check-label">
                                {{ $course->title }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('dashboard.admin.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection
