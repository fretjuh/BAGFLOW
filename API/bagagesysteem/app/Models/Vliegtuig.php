<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vliegtuig extends Model
{
    protected $fillable = [
        'vluchtschema_id',
        'gate_id',
        'model_id',
        'vliegmaatschappij',
    ];

    public function gate()
    {
        return $this->belongsTo(Gate::class);
    }

    public function vluchtschema()
    {
        return $this->belongsTo(Vluchtschema::class);
    }
}