<?php

namespace App\Http\Controllers;

use App\Models\Bagage;
use Illuminate\Http\Request;

class BagageController extends Controller
{
    public function index()
    {
        $bagage = Bagage::all();

        return response()->json([
            'success' => true,
            'data' => $bagage
        ]);
    }

    public function show($rfid)
    {
        $bagage = Bagage::find($rfid);

        if (!$bagage) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'BAGAGE_NIET_GEVONDEN',
                    'message' => "Bagagestuk met RFID $rfid bestaat niet"
                ]
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $bagage
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'rfid'                => 'required|unique:bagage,rfid',
            'timestamp_inlevering'=> 'required|date',
            'status'              => 'required|in:ingeleverd,onderweg,in_zone,bij_gate,uitgeleverd,error',
            'zone_id'             => 'required|exists:zones,id',
            'gate_id'             => 'required',
            'vliegtuig_id'        => 'required|exists:vluchten,id',
        ]);

        $bagage = Bagage::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $bagage
        ], 201);
    }

    public function updateStatus(Request $request, $rfid)
    {
        $bagage = Bagage::find($rfid);

        if (!$bagage) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'BAGAGE_NIET_GEVONDEN',
                    'message' => "Bagagestuk met RFID $rfid bestaat niet"
                ]
            ], 404);
        }

        $request->validate([
            'status' => 'required|in:ingeleverd,onderweg,in_zone,bij_gate,uitgeleverd,error'
        ]);

        $bagage->status = $request->status;
        $bagage->save();

        return response()->json([
            'success' => true,
            'data' => $bagage
        ]);
    }
}