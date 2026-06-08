<?php

namespace App\Http\Controllers;

use App\Models\Vlucht;
use Illuminate\Http\Request;

class VluchtController extends Controller
{
    public function index()
    {
        $vluchten = Vlucht::all();

        return response()->json([
            'success' => true,
            'data' => $vluchten
        ]);
    }

    public function show($id)
    {
        $vlucht = Vlucht::find($id);

        if (!$vlucht) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VLUCHT_NIET_GEVONDEN',
                    'message' => "Vlucht met ID $id bestaat niet"
                ]
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $vlucht
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'vliegtuig_id'   => 'required',
            'gate_id'        => 'required',
            'vluchtschema'   => 'required',
            'aan_gate'       => 'required|date',
            'uit_gate'       => 'required|date|after:aan_gate',
        ]);

        $vlucht = Vlucht::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $vlucht
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $vlucht = Vlucht::find($id);

        if (!$vlucht) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VLUCHT_NIET_GEVONDEN',
                    'message' => "Vlucht met ID $id bestaat niet"
                ]
            ], 404);
        }

        $request->validate([
            'aan_gate' => 'sometimes|date',
            'uit_gate' => 'sometimes|date|after:aan_gate',
        ]);

        $vlucht->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $vlucht
        ]);
    }
}