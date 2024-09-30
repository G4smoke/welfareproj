<?php

// App\Models\User.php

// App\Models\User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Ensure this is included
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Other properties and methods...

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Define the relationship to payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Add the hasOutstandingPayment method
    public function hasOutstandingPayment()
    {
        // Check if the amount owing is greater than 0
        return $this->amountOwing() > 0;
    }

    public function amountOwing()
{
    // Define the monthly payment amount
    $monthlyPaymentAmount = 30.00; // Fixed amount that the user is expected to pay monthly

    // Get the total amount the user has paid
    $totalPaid = $this->payments()->sum('amount_paid'); // Total payments made by the user

    // Determine how many months are owing based on the first payment date or the current date
    // Assuming you have a due date or can determine when payments started
    $firstPaymentDate = $this->payments()->min('payment_date'); // Assuming you have a payment_date field

    // Calculate how many months have passed since the first payment date
    if ($firstPaymentDate) {
        $now = now(); // Get the current date
        $monthsOwing = $now->diffInMonths($firstPaymentDate) + 1; // +1 to include the first month
    } else {
        $monthsOwing = 0; // No payments made yet
    }

    // Calculate total amount owed based on months past due
    $totalOwed = $monthsOwing * $monthlyPaymentAmount;

    // Calculate the amount owing by subtracting total paid from total owed
    return max(0, $totalOwed - $totalPaid);
}

}
