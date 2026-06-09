<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = ['naam', 'positie', 'status_id'];

    public function status()
    {
        return $this->belongsTo(StatusMachine::class, 'status_id');
    }
}