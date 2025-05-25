<!-- resources/views/user/notifications.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>notifications</h2>

        @forelse ($notifications as $notification)
            <div class="alert alert-info">
                <strong>{{ $notification->data['message'] ?? 'رسالة بدون عنوان' }}</strong>
                <p>{{ $notification->data['body'] ?? '' }}</p>
                <small>{{ $notification->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p>No notifications Exsits</p>
        @endforelse
    </div>
@endsection
