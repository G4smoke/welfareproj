<?php

namespace App\Http\Controllers;

use App\Models\Payment; 
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
{
    // Fetch user payments for the current month
    $userId = auth()->id();
    $currentMonth = now()->month;

    // Calculate total paid this month
    $monthlyPaid = Payment::where('user_id', $userId)
        ->whereMonth('payment_date', $currentMonth)
        ->sum('amount_paid');

    // Calculate total paid overall
    $totalPaid = Payment::where('user_id', $userId)->sum('amount_paid');

    // Calculate amount owing
    $amountOwing = auth()->user()->amountOwing(); // Assuming this method is on the User model

    // Calculate next payment date (this example assumes a monthly payment schedule)
    $nextPaymentDate = now()->addMonth()->startOfMonth(); // Change as needed

    return view('user.dashboard', compact('monthlyPaid', 'totalPaid', 'amountOwing', 'nextPaymentDate'));
}

}
