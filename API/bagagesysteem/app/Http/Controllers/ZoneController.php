<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::all();

        return response()->json([
            'success' => true,
            'data' => $zones
        ]);
    }

    public function show($id)
    {
        $zone = Zone::find($id);

        if (!$zone) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'ZONE_NIET_GEVONDEN',
                    'message' => "Zone met ID $id bestaat niet"
                ]
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $zone
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'zone_naam'   => 'required|string',
            'zone_status' => 'required|in:actief,inactief',
        ]);

        $zone = Zone::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $zone
        ], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $zone = Zone::find($id);

        if (!$zone) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'ZONE_NIET_GEVONDEN',
                    'message' => "Zone met ID $id bestaat niet"
                ]
            ], 404);
        }

        $request->validate([
            'zone_status' => 'required|in:actief,inactief',
        ]);

        $zone->zone_status = $request->zone_status;
        $zone->save();

        return response()->json([
            'success' => true,
            'data' => $zone
        ]);
    }
}