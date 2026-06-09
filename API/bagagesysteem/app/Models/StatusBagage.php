<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusBagage extends Model
{
    protected $table = 'status_bagage';

    protected $fillable = ['naam', 'positie', 'omschrijving'];

    public function bagage()
    {
        return $this->hasMany(Bagage::class);
    }

    public function vluchtschemas()
    {
        return $this->hasMany(Vluchtschema::class);
    }
}