<?php

namespace App\Http\Controllers;

use App\Models\Gate;
use Illuminate\Http\Request;

class GateController extends Controller
{
    public function index()
    {
        $gates = Gate::all();

        return response()->json([
            'success' => true,
            'data' => $gates
        ]);
    }

    public function show($id)
    {
        $gate = Gate::find($id);

        if (!$gate) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'GATE_NIET_GEVONDEN',
                    'message' => "Gate met ID $id bestaat niet"
                ]
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $gate
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam'        => 'required|string|max:50',
            'positie'     => 'required|string|max:50',
            'omschrijving'=> 'nullable|string|max:255',
        ]);

        $gate = Gate::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $gate
        ], 201);
    }
    
    public function update(Request $request, Gate $gate)
    {
        $gate->update([
            'is_open' => $request->is_open
        ]);

        return response()->json([
            'success' => true,
            'data' => $gate
        ]);
    }
}