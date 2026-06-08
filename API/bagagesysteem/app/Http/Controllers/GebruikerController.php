<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GebruikerController extends Controller
{
    public function index()
    {
        $gebruikers = User::all(['id', 'name', 'email', 'role']);

        return response()->json([
            'success' => true,
            'data' => $gebruikers
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role'     => 'required|in:medewerker,admin',
        ]);

        $gebruiker = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'id'    => $gebruiker->id,
                'name'  => $gebruiker->name,
                'email' => $gebruiker->email,
                'role'  => $gebruiker->role,
            ]
        ], 201);
    }
}