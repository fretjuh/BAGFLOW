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
        return view('dashboard', [

            'aantalKoffers' => Bagage::count(),

            'verwerktVandaag' => Bagage::whereNotNull('aflevertijd')
                ->whereDate('aflevertijd', today())
                ->count(),

            'zoekStatus' => Bagage::where('status_bagage_id', 3)->count(),

            'statussen' => StatusBagage::withCount('bagages')->get(),

            'machinesActief' => Machine::where('status_id', 1)->count(),

            'gates' => Gate::all(),

            'recenteBagage' => Bagage::latest()->take(5)->get(),

            // 👇 echte zones uit database (ALS zone bestaat)
            'zones' => Bagage::selectRaw('zone, count(*) as totaal')
                ->groupBy('zone')
                ->get(),

            'todayIn' => Bagage::whereDate('inlevertijd', today())->count(),

            'openBagage' => Bagage::whereNull('aflevertijd')->count(),

            'processedToday' => Bagage::whereNotNull('aflevertijd')
                ->whereDate('aflevertijd', today())
                ->count(),
        ]);
    }
}