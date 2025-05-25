@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>My Courses</h2>
    <div class="row">
        @forelse($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $course->title }}</h5>
                        <a href="{{ route('users.my-courses.show', $course->id) }}" class="btn btn-primary">
                            View Videos
                        </a>
                        <form action="{{ route('users.my-courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من إلغاء الاشتراك؟');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm mt-2">إلغاء الاشتراك</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Not Buy Any Courses Yet</p>
        @endforelse
    </div>
</div>
@endsection
