<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable =[
        'room_type',
        'description',
        'price',
        'available_from',
        'available_to',
        'available_rooms',
        'max_children',
        'max_adults',
        'free_pickup',
        'image',
        'is_ac',
        'price_range',
    ];

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
