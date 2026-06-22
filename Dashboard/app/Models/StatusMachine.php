<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusMachine extends Model
{
    protected $table = 'status_machine';

    protected $fillable = ['naam', 'omschrijving'];

    public function machines()
    {
        return $this->hasMany(Machine::class, 'status_id');
    }
}