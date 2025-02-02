<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'review',
        'rating',
        'user_id',
        'room_id',
        
    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function room()
{
    return $this->belongsTo(Room::class,'room_id');
}
}
