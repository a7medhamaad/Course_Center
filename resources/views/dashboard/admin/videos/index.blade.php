@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Courses and Their Videos</h2>

   <a href="{{ route('dashboard.video.create') }}" class="btn btn-primary mb-3">Add Video</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="accordion" id="coursesAccordion">
        @foreach($courses as $course)
            <div class="card">
                <div class="card-header" id="heading{{ $course->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $course->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $course->id }}">
                            {{ $course->title }}
                        </button>
                    </h5>
                </div>

                <div id="collapse{{ $course->id }}" class="collapse" aria-labelledby="heading{{ $course->id }}"
                     data-bs-parent="#coursesAccordion">
                    <div class="card-body">
                        @if($course->videos->count() > 0)
                            @foreach($course->videos as $video)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6>{{ $video->title }}</h6>
                                        <video width="200" height="150" controls>
                                            <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                                            متصفحك لا يدعم عرض الفيديو.
                                        </video>

                                        <form action="{{ route('dashboard.videos.destroy', $video->id) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">No videos available for this course.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
