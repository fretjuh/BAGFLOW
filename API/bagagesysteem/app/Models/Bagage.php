<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bagage extends Model
{
    // RFID is de primaire sleutel, geen standaard id
    protected $primaryKey = 'rfid';

    // RFID is een string, geen integer
    protected $keyType = 'string';

    // Laravel mag de sleutel niet automatisch ophogen
    public $incrementing = false;

    // Welke velden mogen worden ingevuld via create() of update()
    protected $fillable = [
        'rfid',
        'timestamp_inlevering',
        'timestamp_uitlevering',
        'status',
        'zone_id',
        'gate_id',
        'vliegtuig_id',
    ];

    // Relatie: een bagagestuk hoort bij één vlucht
    public function vlucht()
    {
        return $this->belongsTo(Vlucht::class, 'vliegtuig_id');
    }

    // Relatie: een bagagestuk hoort bij één zone
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}