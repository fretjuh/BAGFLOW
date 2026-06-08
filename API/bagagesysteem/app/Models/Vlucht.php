<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vlucht extends Model
{
    protected $fillable = [
        'vliegtuig_id',
        'gate_id',
        'vluchtschema',
        'aan_gate',
        'uit_gate',
    ];

    // Relatie: een vlucht heeft meerdere bagagestukken
    public function bagage()
    {
        return $this->hasMany(Bagage::class, 'vliegtuig_id');
    }
}