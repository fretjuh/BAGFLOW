<?php

namespace App\Http\Controllers;

use App\Models\StatusMachine;

class StatusMachineController extends Controller
{
    public function index()
    {
        $statussen = StatusMachine::all();

        return response()->json([
            'success' => true,
            'data' => $statussen
        ]);
    }
}