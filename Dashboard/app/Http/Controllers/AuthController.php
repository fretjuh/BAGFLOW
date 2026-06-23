<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'      => 'required|email',
            'wachtwoord' => 'required',
        ]);

        $gebruiker = User::where('email', $request->email)->first();

        if (!$gebruiker || !Hash::check($request->wachtwoord, $gebruiker->wachtwoord)) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code'    => 'ONGELDIGE_INLOGGEGEVENS',
                    'message' => 'E-mailadres of wachtwoord is onjuist'
                ]
            ], 401);
        }

        $token = $gebruiker->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token,
                'role'  => $gebruiker->role,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'data'    => null
        ]);
    }
}