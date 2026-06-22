<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusBagageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('status_bagage')->truncate();

        DB::table('status_bagage')->insert([
            [
                'id' => 1,
                'naam' => 'inname',
                'positie' => 1,
                'omschrijving' => 'Koffer is ingevoerd in het systeem.',
            ],
            [
                'id' => 2,
                'naam' => 'sorteren',
                'positie' => 2,
                'omschrijving' => 'Koffer wordt gesorteerd.',
            ],
            [
                'id' => 3,
                'naam' => 'opgeslagen',
                'positie' => 3,
                'omschrijving' => 'Bagage is opgeslagen in het bagage rek voor een latere vlucht.',
            ],
            [
                'id' => 4,
                'naam' => 'afgeleverd',
                'positie' => 4,
                'omschrijving' => 'Bagage is afgeleverd bij de passagier.',
            ],
            [
                'id' => 5,
                'naam' => 'zoek',
                'positie' => 5,
                'omschrijving' => 'Bagage is zoek. Contacteer de helpdesk voor verdere informatie.',
            ],
        ]);
    }
}