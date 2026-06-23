<?php

namespace App\Http\Controllers;

use App\Models\Vluchtschema;
use Illuminate\Http\Request;

class VluchtschemaController extends Controller
{
    public function index()
    {
        $schemas = Vluchtschema::with(['gate', 'vliegtuig', 'statusBagage'])->get();

        return response()->json([
            'success' => true,
            'data' => $schemas
        ]);
    }

    public function show($id)
    {
        $schema = Vluchtschema::with(['gate', 'vliegtuig', 'statusBagage'])->find($id);

        if (!$schema) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VLUCHTSCHEMA_NIET_GEVONDEN',
                    'message' => "Vluchtschema met ID $id bestaat niet"
                ]
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $schema
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'gate_id'          => 'required|exists:gates,id',
            'vliegtuig_id'     => 'required|exists:vliegtuigen,id',
            'status_bagage_id' => 'required|exists:status_bagage,id',
            'vertrektijd'      => 'required|date',
            'vertraging'       => 'integer|min:0',
        ]);

        $schema = Vluchtschema::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $schema
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $schema = Vluchtschema::find($id);

        if (!$schema) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VLUCHTSCHEMA_NIET_GEVONDEN',
                    'message' => "Vluchtschema met ID $id bestaat niet"
                ]
            ], 404);
        }

        $request->validate([
            'vertrektijd' => 'sometimes|date',
            'vertraging'  => 'sometimes|integer|min:0',
            'gate_id'     => 'sometimes|exists:gates,id',
        ]);

        $schema->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $schema
        ]);
    }
}