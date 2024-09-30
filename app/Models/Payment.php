<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',        // Include user_id for mass assignment
        'amount_paid',
        'amount_owing',
        'status',
        'reference',      // Include reference to store Paystack reference
        'payment_date',   // Include payment_date if you want to store it
    ];
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'payment_date' => 'datetime', // This will cast payment_date to a Carbon instance
    ];
    
}
