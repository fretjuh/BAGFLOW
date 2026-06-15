<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BagageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bagages')->truncate();

        DB::table('bagages')->insert([
            [
                'id' => 1,
                'status_bagage_id' => 1,
                'omschrijving' => 'Zwarte Samsonite koffer',
                'inlevertijd' => '2025-06-15 08:00:00',
                'rfid' => 'RFID0001',
                'aflevertijd' => null,
            ],
            [
                'id' => 2,
                'status_bagage_id' => 2,
                'omschrijving' => 'Blauwe handbagage',
                'inlevertijd' => '2025-06-15 08:15:00',
                'rfid' => 'RFID0002',
                'aflevertijd' => '2025-06-15 12:30:00',
            ],
            [
                'id' => 3,
                'status_bagage_id' => 3,
                'omschrijving' => 'Rode reiskoffer',
                'inlevertijd' => '2025-06-15 08:30:00',
                'rfid' => 'RFID0003',
                'aflevertijd' => null,
            ],
            [
                'id' => 4,
                'status_bagage_id' => 4,
                'omschrijving' => 'Grijze sporttas',
                'inlevertijd' => '2025-06-15 08:45:00',
                'rfid' => 'RFID0004',
                'aflevertijd' => null,
            ],
            [
                'id' => 5,
                'status_bagage_id' => 1,
                'omschrijving' => 'Groene rugzak',
                'inlevertijd' => '2025-06-15 09:00:00',
                'rfid' => 'RFID0005',
                'aflevertijd' => null,
            ],
            [
                'id' => 6,
                'status_bagage_id' => 2,
                'omschrijving' => 'Zilveren trolley',
                'inlevertijd' => '2025-06-15 09:15:00',
                'rfid' => 'RFID0006',
                'aflevertijd' => '2025-06-15 13:10:00',
            ],
            [
                'id' => 7,
                'status_bagage_id' => 3,
                'omschrijving' => 'Bruine lederen tas',
                'inlevertijd' => '2025-06-15 09:30:00',
                'rfid' => 'RFID0007',
                'aflevertijd' => null,
            ],
            [
                'id' => 8,
                'status_bagage_id' => 4,
                'omschrijving' => 'Kinderkoffer met stickers',
                'inlevertijd' => '2025-06-15 09:45:00',
                'rfid' => 'RFID0008',
                'aflevertijd' => null,
            ],
            [
                'id' => 9,
                'status_bagage_id' => 1,
                'omschrijving' => 'Zwarte weekendtas',
                'inlevertijd' => '2025-06-15 10:00:00',
                'rfid' => 'RFID0009',
                'aflevertijd' => null,
            ],
            [
                'id' => 10,
                'status_bagage_id' => 2,
                'omschrijving' => 'Gele handbagage',
                'inlevertijd' => '2025-06-15 10:15:00',
                'rfid' => 'RFID0010',
                'aflevertijd' => '2025-06-15 14:20:00',
            ],
        ]);
    }
}