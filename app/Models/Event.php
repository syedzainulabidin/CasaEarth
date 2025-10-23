<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Event extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $casts = [
        'date_time' => 'datetime',
    ];

    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }
}
