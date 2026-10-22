<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_id' => 'required|exists:school,id',
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric',
            'method' => 'required|string',
            'reference' => 'required|string',
            'payment_date' => 'required|date',
        ]);

        $payment = Payment::create([
            'school_id' => $validated['school_id'],
            'student_id' => $validated['student_id'],
            'amount' => $validated['amount'],
            'reference' => $validated['referencr'],
            'status' => 'approved',
            'payment_date' => $validated['payment_date'],
        ]);

        return response()->json([
            'message' => 'Payment recorded successfully',
            'payment' => $payment
        ], 201);
    }
}
