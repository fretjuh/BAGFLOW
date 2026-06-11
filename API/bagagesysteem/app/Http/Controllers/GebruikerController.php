<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GebruikerController extends Controller
{
    public function index()
    {
        $gebruikers = User::all(['id', 'naam', 'email', 'role']);

        return response()->json([
            'success' => true,
            'data' => $gebruikers
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam'      => 'required|string',
            'email'     => 'required|email|unique:gebruikers,email',
            'wachtwoord'=> 'required|min:8',
            'role'      => 'required|in:medewerker,admin',
        ]);

        $gebruiker = User::create([
            'naam'       => $request->naam,
            'email'      => $request->email,
            'wachtwoord' => Hash::make($request->wachtwoord),
            'role'       => $request->role,
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'id'    => $gebruiker->id,
                'naam'  => $gebruiker->naam,
                'email' => $gebruiker->email,
                'role'  => $gebruiker->role,
            ]
        ], 201);
    }
}