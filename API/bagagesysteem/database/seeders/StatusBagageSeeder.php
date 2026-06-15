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
                'naam' => 'onderweg',
                'positie' => 1,
                'omschrijving' => 'Koffer wordt gesorteerd.',
            ],
            [
                'id' => 2,
                'naam' => 'afgeleverd',
                'positie' => 2,
                'omschrijving' => 'Afgeleverd bij de gate of bagage ophaal punt.',
            ],
            [
                'id' => 3,
                'naam' => 'opgeslagen',
                'positie' => 3,
                'omschrijving' => 'Bagage is opgeslagen in het bagage rek voor een latere vlucht.',
            ],
            [
                'id' => 4,
                'naam' => 'zoek',
                'positie' => 4,
                'omschrijving' => 'Contacteer de helpdesk voor verdere informatie.',
            ],
        ]);
    }
}