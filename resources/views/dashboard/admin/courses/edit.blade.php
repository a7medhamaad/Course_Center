@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h2>تعديل الكورس</h2>

    <form action="{{ route('dashboard.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>اسم الكورس</label>
            <input type="text" name="title" class="form-control" value="{{ $course->title }}">
        </div>

        <div class="form-group">
            <label>الوصف</label>
            <textarea name="description" class="form-control">{{ $course->description }}</textarea>
        </div>

        <div class="form-group">
            <label>السعر</label>
            <input type="number" name="price" class="form-control" value="{{ $course->price }}">
        </div>

        <div class="form-group">
            <label>الفئة</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $course->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>رابط الفيديو</label>
            <input type="url" name="video_url" class="form-control" value="{{ $course->video_url }}">
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
        <a href="{{ route('dashboard.courses.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
