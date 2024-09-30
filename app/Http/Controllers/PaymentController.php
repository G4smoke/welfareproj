<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use App\Exports\PaymentsExport;  
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class PaymentController extends Controller
{
    // Show the payment form based on user type (admin or regular user)
    public function showPaymentForm()
    {
        if (auth()->user()->usertype === 'admin') {
            return view('payments.admin');  // Admin payment view
        }
        return view('payments.user');  // User payment view
    }

    // Process payment via Paystack
    public function processPayment(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
        ]);

        // Set your Paystack secret key
        $secretKey = env('PAYSTACK_SECRET_KEY');

        // Create a new payment using Paystack API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $secretKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.paystack.co/transaction/initialize', [
            'email' => $request->email,
            'amount' => $request->amount * 100, // Amount in kobo
            'callback_url' => route('payment.callback'), // Set your callback URL
        ]);

        $responseData = $response->json();

        if ($response->successful() && isset($responseData['data']['authorization_url'])) {
            return redirect($responseData['data']['authorization_url']);
        }

        return back()->withErrors(['error' => 'Payment initialization failed.']);
    }

    // Handle Paystack callback for payment verification
    public function handleCallback()
    {
        // Get the transaction reference from the request
        $reference = request()->query('reference');

        // Verify the transaction with Paystack API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
        ])->get("https://api.paystack.co/transaction/verify/$reference");

        if ($response->successful()) {
            $transactionData = $response->json();

            // Check if the transaction was successful
            if ($transactionData['data']['status'] === 'success') {
                $amount = $transactionData['data']['amount'] / 100; // Convert kobo to currency
                $transactionId = $transactionData['data']['id'];
                $userId = auth()->id();

                // Fetch current user and calculate the new amount owing
                $user = auth()->user();
                $monthlyDue = $user->monthly_due ?? 100.00; // Default monthly due
                $totalPaid = Payment::where('user_id', $userId)->sum('amount_paid');
                $totalMonthsPassed = $user->created_at->diffInMonths(now());
                $totalAmountDue = $totalMonthsPassed * $monthlyDue;

                $newAmountOwing = max(0, $totalAmountDue - ($totalPaid + $amount));

                // Save the new payment with amount_owing
                Payment::create([
                    'user_id' => $userId,
                    'amount_paid' => $amount,
                    'amount_owing' => $newAmountOwing,
                    'status' => 'Paid',
                    'reference' => $transactionId,
                    'payment_date' => now(),
                    'payment_type' => 'regular'
                ]);

                // Redirect based on user role
                if ($user->usertype === 'admin') {
                    return redirect()->route('payment.admin')->with('success', 'Payment was successful.');
                } else {
                    return redirect()->route('payment.user')->with('success', 'Payment was successful.');
                }
            }
        }

        return redirect()->route('payment.user')->with('error', 'Payment verification failed.');
    }

    // Show the user's payment history and calculate the amount owing
    public function userPaymentHistory()
    {
        $userId = auth()->user()->id;
        $user = auth()->user();

        // Set the monthly payment amount
        $monthlyPaymentAmount = $user->monthly_due ?? 30.00; // Default monthly due

        // Get the user's start date
        $startDate = $user->created_at;

        // Calculate how many months have passed since the user started
        $monthsPassed = $startDate->diffInMonths(now());

        // Calculate total due based on months passed
        $totalDue = $monthsPassed * $monthlyPaymentAmount;

        // Fetch all payments made by the user
        $payments = Payment::where('user_id', $userId)->get();

        // Calculate the total amount paid by the user
        $totalPaid = $payments->sum('amount_paid');

        // Calculate the amount owing
        $amountOwing = max(0, $totalDue - $totalPaid);

        return view('user.payment-history', compact('payments', 'totalPaid', 'amountOwing'));
    }

    // Admin view of all payment records for all users
    public function adminPaymentRecord()
    {
        // Fetch all payment records for all users
        $payments = Payment::all();

        // Get the authenticated admin user
        $admin = auth()->user();

        return view('admin.record', compact('payments', 'admin'));
    }

    // Admin view of the admin's personal payment history
    public function adminPaymentHistory()
    {
        $adminId = auth()->user()->id;
        $payments = Payment::where('user_id', $adminId)->get();

        return view('admin.payment-history', compact('payments'));
    }

    // Export payment data to an Excel file
    public function PaymentsExport()
    {
        return Excel::download(new PaymentsExport, 'payments.xlsx');
    }

    // Export payment data to an Excel file
    public function export()
    {
        return Excel::download(new PaymentsExport, 'payments.xlsx');
    }
}
