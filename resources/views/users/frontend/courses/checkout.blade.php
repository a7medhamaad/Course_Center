@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <h2 class="mb-4 text-center">دفع قيمة الكورس: <span class="text-primary">{{ $course->title }}</span></h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-4">السعر: <strong>{{ number_format($course->price, 2) }} EGP</strong></h5>

            <form action="{{ route('users.courses.pay', $course->id) }}" method="POST" id="payment-form">
                @csrf
                <div class="form-group mb-3">
                    <label for="card-element" class="form-label">معلومات البطاقة:</label>
                    <div id="card-element" class="form-control p-2"
                        style="border-radius: 6px; border: 1px solid #ced4da;"></div>
                    <div id="card-errors" class="text-danger mt-2" role="alert"></div>
                </div>

                <input type="hidden" name="course_title" value="{{ $course->title }}">
                <input type="hidden" name="price" value="{{ $course->price }}">

                <button class="btn btn-success w-100 py-2" type="submit">ادفع الآن</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config("services.stripe.key") }}');
    const elements = stripe.elements();

    const style = {
        base: {
            color: '#212529',
            fontFamily: '"Segoe UI", Tahoma, Geneva, Verdana, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#6c757d'
            }
        },
        invalid: {
            color: '#dc3545',
            iconColor: '#dc3545'
        }
    };

    const card = elements.create('card', { style: style, hidePostalCode: true });
    card.mount('#card-element');

    card.on('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        const { error, token } = await stripe.createToken(card);

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            let hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            form.submit();
        }
    });
</script>
@endpush
