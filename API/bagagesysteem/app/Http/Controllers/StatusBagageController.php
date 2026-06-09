<?php

namespace App\Http\Controllers;

use App\Models\StatusBagage;

class StatusBagageController extends Controller
{
    public function index()
    {
        $statussen = StatusBagage::all();

        return response()->json([
            'success' => true,
            'data' => $statussen
        ]);
    }
}