@extends('layouts.dashboard')

@section('content')
<div class="container">
    {{-- ✅ جدول الأدمن --}}
    <h2 class="mb-3">Admins</h2>
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        <a href="{{ route('dashboard.admin.show', $admin->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('dashboard.admin.edit', $admin->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('dashboard.admin.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No Admins Found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ✅ جدول اليوزر --}}
    <h2 class="mt-5 mb-3">Users</h2>
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Purchased Courses</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->courses->isNotEmpty())
                            <ul class="mb-0 pl-3">
                                @foreach($user->courses as $course)
                                    <li>{{ $course->title }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('dashboard.admin.show', $user->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('dashboard.admin.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('dashboard.admin.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No Users Found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
