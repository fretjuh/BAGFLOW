<?php

namespace App\Http\Controllers;

use App\Models\Bagage;
use App\Models\Gate;
use App\Models\Machine;
use App\Models\StatusBagage;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $gates = Gate::query()->orderBy('id')->get();
        $machines = Machine::with('status')->orderBy('id')->get();
        $bagages = Bagage::with('status')->orderByDesc('inlevertijd')->get();
        $bagageStatuses = StatusBagage::withCount('bagage')->orderBy('id')->get();

        $hourLabels = collect(range(0, 23))->map(fn (int $hour) => sprintf('%02d:00', $hour))->all();
        $processedData = array_fill(0, 24, 0);
        $deliveredData = array_fill(0, 24, 0);

        foreach ($bagages as $bagage) {
            if ($bagage->inlevertijd) {
                $hour = Carbon::parse($bagage->inlevertijd)->hour;
                $processedData[$hour]++;
            }

            if ($bagage->aflevertijd) {
                $hour = Carbon::parse($bagage->aflevertijd)->hour;
                $deliveredData[$hour]++;
            }
        }

        $bagageStatusLabels = $bagageStatuses->map(fn ($status) => $status->naam)->values()->all();
        $bagageStatusData = $bagageStatuses->map(fn ($status) => (int) $status->bagage_count)->values()->all();

        $summary = [
            'totalBagage' => $bagages->count(),
            'processedToday' => Bagage::whereDate('aflevertijd', now()->toDateString())->count(),
            'missing' => (int) ($bagageStatuses->firstWhere('naam', 'zoek')->bagage_count ?? 0),
            'openGates' => $gates->where('is_open', true)->count(),
            'machinesActive' => $machines->filter(fn ($machine) => optional($machine->status)->naam === 'actief')->count(),
            'machinesTotal' => $machines->count(),
            'machinesMaintenance' => $machines->filter(fn ($machine) => optional($machine->status)->naam === 'onderhoud')->count(),
        ];

        $gateCards = $gates->map(function ($gate) {
            return [
                'name' => $gate->naam,
                'position' => $gate->positie,
                'open' => (bool) $gate->is_open,
                'description' => $gate->omschrijving,
            ];
        })->values()->all();

        $machineCards = $machines->map(function ($machine) {
            $statusName = $machine->status->naam ?? 'inactief';

            return [
                'name' => $machine->naam,
                'position' => $machine->positie,
                'status' => $statusName,
            ];
        })->values()->all();

        $eventCards = collect();

        foreach ($gates->take(3) as $gate) {
            $eventCards->push([
                'dot' => $gate->is_open ? '#22c55e' : '#f59e0b',
                'text' => 'Gate ' . $gate->naam . ' staat ' . ($gate->is_open ? 'open' : 'gesloten') . ' op ' . $gate->positie . '.',
                'time' => optional($gate->updated_at)->format('H:i') ?? now()->format('H:i'),
            ]);
        }

        foreach ($machines->take(3) as $machine) {
            $eventCards->push([
                'dot' => '#60a5fa',
                'text' => 'Machine ' . $machine->naam . ' heeft status ' . ($machine->status->naam ?? 'onbekend') . '.',
                'time' => optional($machine->updated_at)->format('H:i') ?? now()->format('H:i'),
            ]);
        }

        foreach ($bagages->take(3) as $bagage) {
            $eventCards->push([
                'dot' => '#fbbf24',
                'text' => 'Bagage ' . $bagage->rfid . ' heeft status ' . ($bagage->status->naam ?? 'onbekend') . '.',
                'time' => optional($bagage->updated_at)->format('H:i') ?? now()->format('H:i'),
            ]);
        }

        return view('dashboard', compact(
            'gates',
            'machines',
            'bagages',
            'summary',
            'bagageStatusLabels',
            'bagageStatusData',
            'hourLabels',
            'processedData',
            'deliveredData',
            'gateCards',
            'machineCards',
            'eventCards'
        ));
    }
}
