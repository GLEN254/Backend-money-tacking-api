<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        return User::create($validated);
    }

    public function show($id)
    {
        $user = User::with('wallets.transactions')->findOrFail($id);

        $totalBalance = $user->wallets->sum->balance;

        return response()->json([
            'user' => $user,
            'wallets' => $user->wallets->map(function ($wallet) {
                return [
                    'id' => $wallet->id,
                    'name' => $wallet->name,
                    'balance' => $wallet->balance,
                ];
            }),
            'total_balance' => $totalBalance
        ]);
    }
} 