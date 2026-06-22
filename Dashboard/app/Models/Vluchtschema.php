<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vluchtschema extends Model
{
    protected $fillable = [
        'gate_id',
        'vliegtuig_id',
        'status_bagage_id',
        'vertrektijd',
        'vertraging',
    ];

    public function gate()
    {
        return $this->belongsTo(Gate::class);
    }

    public function vliegtuig()
    {
        return $this->belongsTo(Vliegtuig::class);
    }

    public function statusBagage()
    {
        return $this->belongsTo(StatusBagage::class);
    }
}