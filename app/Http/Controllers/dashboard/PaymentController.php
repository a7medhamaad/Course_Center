<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
     public function index()
    {
        $payments = Payment::with('user', 'course')->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.payments.index', compact('payments'));
    }
}
