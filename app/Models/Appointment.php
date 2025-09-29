<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function therapist()
{
    return $this->belongsTo(Therapist::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
