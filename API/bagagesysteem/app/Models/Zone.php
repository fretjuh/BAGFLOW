<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'zone_naam',
        'zone_status',
    ];

    // Relatie: een zone heeft meerdere bagagestukken
    public function bagage()
    {
        return $this->hasMany(Bagage::class);
    }
}