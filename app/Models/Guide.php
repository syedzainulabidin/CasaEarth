<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Guide extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];
    public function users()
{
    return $this->belongsToMany(User::class, 'myguides');
}

}
