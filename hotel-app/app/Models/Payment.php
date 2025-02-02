<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'phone',
        'payment_method',
        'card_number',
        'cardholder_name',
        'expiry_date',
        'cvv',
    ];

     // Casts for sensitive data to encrypt and decrypt automatically
     protected $casts = [
        'card_number' => 'encrypted',
        'cvv' => 'encrypted',
    ];
}
