<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gate extends Model
{
    protected $fillable = [
        'naam',
        'positie',
        'omschrijving',
        'is_open'
    ];

    public function vliegtuigen()
    {
        return $this->hasMany(Vliegtuig::class);
    }

    public function vluchtschemas()
    {
        return $this->hasMany(Vluchtschema::class);
    }
}