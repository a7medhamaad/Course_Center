@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2>User Buy Courses</h2>

    @foreach($courses as $course)
        <div class="card mt-4">
            <div class="card-header">
                <strong>{{ $course->title }}</strong> ( User Count: {{ $course->users->count() }})
            </div>
            <div class="card-body">
                @if($course->users->isEmpty())
                    <p>Not User In this Course</p>
                @else
                    <ul class="list-group">
                        @foreach($course->users as $user)
                            <li class="list-group-item">
                                {{ $user->name }} - {{ $user->email }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
