<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::with('status')->get();

        return response()->json([
            'success' => true,
            'data' => $machines
        ]);
    }

    public function show($id)
    {
        $machine = Machine::with('status')->find($id);

        if (!$machine) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'MACHINE_NIET_GEVONDEN',
                    'message' => "Machine met ID $id bestaat niet"
                ]
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $machine
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam'      => 'required|string|max:50',
            'positie'   => 'required|string|max:50',
            'status_id' => 'required|exists:status_machine,id',
        ]);

        $machine = Machine::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $machine
        ], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $machine = Machine::find($id);

        if (!$machine) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'MACHINE_NIET_GEVONDEN',
                    'message' => "Machine met ID $id bestaat niet"
                ]
            ], 404);
        }

        $request->validate([
            'status_id' => 'required|exists:status_machine,id',
        ]);

        $machine->status_id = $request->status_id;
        $machine->save();

        return response()->json([
            'success' => true,
            'data' => $machine->load('status')
        ]);
    }
}