@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h2>إضافة كورس جديد</h2>

    <form action="{{ route('dashboard.courses.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>اسم الكورس</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label>الوصف</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>السعر</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="form-group">
            <label>الفئة</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>رابط الفيديو</label>
            <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}">
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('dashboard.courses.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
