<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Myguide extends Model
{
    protected $guarded = [];
    public function guide()
{
    return $this->belongsTo(Guide::class);
}

}
