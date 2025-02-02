<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'adults',
        'children',
        'total_price',
        'payment_status',
        'reference_number',
        'expires_at',
        'canceled_at',
        'refund_status',
    ];
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    protected $casts = [
        'expires_at' => 'datetime',
        'canceled_at' => 'datetime'
    ];
}
