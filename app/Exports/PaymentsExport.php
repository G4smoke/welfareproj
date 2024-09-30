<?php

namespace App\Exports;

use App\Models\Payment;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch all users with their payments
        $users = User::with('payments')->get();

        // Prepare the data array
        $data = [];

        foreach ($users as $user) {
            // Initialize an array for each user with the user's name
            $userData = ['User Name' => $user->name];

            // Fetch monthly payments grouped by month
            $monthlyPayments = $user->payments()
                ->selectRaw('MONTH(payment_date) as month, SUM(amount_paid) as total_paid')
                ->groupBy('month')
                ->get()
                ->keyBy('month'); // Key by month for easy access

            // Loop through the months and fill the data
            for ($month = 1; $month <= 12; $month++) {
                // Use the month name as the key
                $monthName = date('M', mktime(0, 0, 0, $month, 1)); // Get month name (Jan, Feb, etc.)
                $totalPaid = $monthlyPayments->has($month) ? $monthlyPayments[$month]->total_paid : 0;
                $amountOwing = max(0, 30 - $totalPaid); // Assuming monthly payment is 30

                // Add the total paid and amount owing to the user data
                $userData["{$monthName} Paid"] = $totalPaid;
                $userData["{$monthName} Owing"] = $amountOwing;
            }

            // Add the user data to the main data array
            $data[] = $userData;
        }

        return collect($data);
    }

    public function headings(): array
    {
        // Create headings for the user name and each month
        $headings = ['User Name'];

        // Add month headings
        foreach (range(1, 12) as $month) {
            $monthName = date('M', mktime(0, 0, 0, $month, 1)); // Get month name (Jan, Feb, etc.)
            $headings[] = "{$monthName} Paid";
            $headings[] = "{$monthName} Owing";
        }

        return $headings;
    }
}
