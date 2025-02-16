<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Password extends Model
{
    use HasFactory;

    protected $table = 'password_resets'; // Specify the table name

    public $timestamps = false; // No `updated_at` or `created_at` by default

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];
}
