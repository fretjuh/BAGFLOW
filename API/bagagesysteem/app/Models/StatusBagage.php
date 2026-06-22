<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusBagage extends Model
{
    protected $table = 'status_bagage';

    protected $fillable = [
        'naam',
        'positie',
        'omschrijving'
    ];

    public function bagages()
    {
        return $this->hasMany(
            Bagage::class,
            'status_bagage_id'
        );
    }

    public function vluchtschemas()
    {
        return $this->hasMany(Vluchtschema::class);
    }
}