<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bagage extends Model
{
    protected $fillable = [
        'status_bagage_id',
        'omschrijving',
        'inlevertijd',
        'rfid',
        'aflevertijd',
    ];

    public function status()
    {
        return $this->belongsTo(StatusBagage::class, 'status_bagage_id');
    }
}