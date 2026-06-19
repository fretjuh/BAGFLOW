<?php

namespace App\Http\Controllers;

use App\Models\Bagage;
use Illuminate\Http\Request;

class BagageController extends Controller
{
    public function index()
    {
        $bagage = Bagage::with('status')->get();

        return response()->json([
            'success' => true,
            'data' => $bagage
        ]);
    }

    public function latestRfid()
    {
        $latestRfid = Bagage::max('rfid');

        if (!$latestRfid || $latestRfid < 1000) {
            $latestRfid = 1000;
        }

        return response()->json([
            'success' => true,
            'rfid' => (int) $latestRfid,
        ]);
    }

    public function show($id)
    {
        $bagage = Bagage::with('status')->find($id);

        if (!$bagage) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'BAGAGE_NIET_GEVONDEN',
                    'message' => "Bagagestuk met ID $id bestaat niet"
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
            'status_bagage_id' => 'required|exists:status_bagage,id',
            'omschrijving'     => 'nullable|string',
            'inlevertijd'      => 'required|date',
            'rfid'             => 'required|string|unique:bagage,rfid',
            'aflevertijd'      => 'nullable|date|after:inlevertijd',
        ]);

        $bagage = Bagage::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $bagage
        ], 201);
    }

    public function updateStatusBagage(Request $request, $id)
    {
        $bagage = Bagage::find($id);

        if (!$bagage) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'BAGAGE_NIET_GEVONDEN',
                    'message' => "Bagagestuk met ID $id bestaat niet"
                ]
            ], 404);
        }

        $request->validate([
            'status_bagage_id' => 'required|exists:status_bagage,id',
        ]);

        $bagage->status_bagage_id = $request->status_bagage_id;
        $bagage->save();

        return response()->json([
            'success' => true,
            'data' => $bagage->load('status')
        ]);
    }
}