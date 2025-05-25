@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload New Video</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.video.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Video Title:</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label for="course_id">Choose Course:</label>
            <select name="course_id" class="form-control" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="video">Choose Video File:</label>
            <input type="file" name="video" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Upload Video</button>
    </form>
</div>
@endsection
