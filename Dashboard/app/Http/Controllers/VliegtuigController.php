<?php

namespace App\Http\Controllers;

use App\Models\Vliegtuig;
use Illuminate\Http\Request;

class VliegtuigController extends Controller
{
    public function index()
    {
        $vliegtuigen = Vliegtuig::with(['gate', 'vluchtschema'])->get();

        return response()->json([
            'success' => true,
            'data' => $vliegtuigen
        ]);
    }

    public function show($id)
    {
        $vliegtuig = Vliegtuig::with(['gate', 'vluchtschema'])->find($id);

        if (!$vliegtuig) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VLIEGTUIG_NIET_GEVONDEN',
                    'message' => "Vliegtuig met ID $id bestaat niet"
                ]
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $vliegtuig
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'vliegmaatschappij' => 'required|string|max:100',
            'gate_id'           => 'nullable|exists:gates,id',
            'vluchtschema_id'   => 'nullable|exists:vluchtschemas,id',
        ]);

        $vliegtuig = Vliegtuig::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $vliegtuig
        ], 201);
    }
}