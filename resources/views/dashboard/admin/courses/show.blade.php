@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h2>تفاصيل الكورس</h2>

    <div class="card">
        <div class="card-header">
            <h4>{{ $courses->title }}</h4>
        </div>
        <div class="card-body">
            <p><strong>الوصف:</strong> {{ $courses->description }}</p>
            <p><strong>السعر:</strong> {{ $courses->price }} EGP</p>
            <p><strong>الفئة:</strong> {{ $courses->category->name ?? 'غير محددة' }}</p>
            <p><strong>رابط الفيديو:</strong> 
                <a href="{{ $courses->video_url }}" target="_blank">مشاهدة</a>
            </p>
        </div>
    </div>

    <a href="{{ route('dashboard.courses.index') }}" class="btn btn-secondary mt-3">رجوع</a>
</div>
@endsection
