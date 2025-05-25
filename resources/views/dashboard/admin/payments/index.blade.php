@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Payments List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Course</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->user->name ?? 'N/A' }}</td>
                    <td>{{ $payment->course->title ?? 'N/A' }}</td>
                    <td>{{ $payment->amount }} EGP</td>
                    <td>{{ ucfirst($payment->payment_method) }}</td>
                    <td>{{ ucfirst($payment->payment_status) }}</td>
                    <td>{{ $payment->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No payments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
