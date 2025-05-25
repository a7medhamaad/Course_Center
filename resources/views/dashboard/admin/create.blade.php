@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Create User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.admin.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('dashboard.admin.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
