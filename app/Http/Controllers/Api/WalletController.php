<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string'
        ]);

        return Wallet::create($validated);
    }

    public function show($id)
    {
        $wallet = Wallet::with('transactions')->findOrFail($id);

        return response()->json([
            'wallet' => $wallet,
            'balance' => $wallet->balance,
            'transactions' => $wallet->transactions
        ]);
    }
}



