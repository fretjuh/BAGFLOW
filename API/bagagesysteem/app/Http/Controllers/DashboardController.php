<?php

namespace App\Http\Controllers;

use App\Models\Bagage;
use App\Models\StatusBagage;
use App\Models\Machine;
use App\Models\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        // Statuses with baggage counts
        $statussen = StatusBagage::withCount('bagages')->get();

        // Map statuses to dashboard zones
        $zonesMap = [
            0 => $statussen->firstWhere('id', 1)?->bagages_count ?? 0, // Inname
            1 => $statussen->firstWhere('id', 2)?->bagages_count ?? 0, // Sorteren
            2 => $statussen->firstWhere('id', 4)?->bagages_count ?? 0, // Afgeleverd Bagage
            3 => $statussen->firstWhere('id', 3)?->bagages_count ?? 0, // Opgeslagen
            4 => $statussen->firstWhere('id', 4)?->bagages_count ?? 0, // Afgeleverd Gate
        ];

        return view('dashboard', [
            'aantalKoffers' => Bagage::count(),

            'verwerktVandaag' => Bagage::whereNotNull('aflevertijd')
                ->whereDate('aflevertijd', today())
                ->count(),

            'zoekStatus' => Bagage::where('status_bagage_id', 5)->count(),

            'statussen' => $statussen,

            'machinesActief' => Machine::where('status_id', 1)->count(),

            'gates' => Gate::all(),

            'recenteBagage' => Bagage::latest()->take(5)->get(),

            // THIS WAS MISSING
            'zonesMap' => $zonesMap,

            'todayIn' => Bagage::whereDate('inlevertijd', today())->count(),

            'openBagage' => Bagage::whereNull('aflevertijd')->count(),

            'processedToday' => Bagage::whereNotNull('aflevertijd')
                ->whereDate('aflevertijd', today())
                ->count(),
        ]);
    }
}