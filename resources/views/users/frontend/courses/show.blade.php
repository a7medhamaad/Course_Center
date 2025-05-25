@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $course->name }}</h2>

    @if ($course->videos->isEmpty())
        <div class="alert alert-warning">
            This course does not contain any videos.
        </div>
    @else
        <div class="list-group mb-4">
            @foreach ($course->videos as $video)
                <a href="#video-player" 
                   class="list-group-item list-group-item-action" 
                   onclick="loadVideo('{{ asset('storage/' . $video->video_path) }}')">
                    {{ $video->title }}
                </a>
            @endforeach
        </div>

        <div id="video-player">
            <video id="mainVideo" width="100%" height="480" controls>
                <source id="videoSource" src="{{ asset('storage/' . $course->videos->first()->video_path) }}" type="video/mp4">
                متصفحك لا يدعم تشغيل الفيديو.
            </video>
        </div>
    @endif
</div>

<script>
    function loadVideo(videoUrl) {
        const video = document.getElementById('mainVideo');
        const source = document.getElementById('videoSource');
        source.src = videoUrl;
        video.load();
        video.play();
    }
</script>
@endsection
