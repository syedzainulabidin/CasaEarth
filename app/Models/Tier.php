<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tier extends Model
{
    use HasFactory, Notifiable;

    // Allow mass assignment for all attributes
    protected $guarded = [];

    // Automatically cast JSON 'includes' field to array
    protected $casts = [
        'includes' => 'array',
    ];
    
}
