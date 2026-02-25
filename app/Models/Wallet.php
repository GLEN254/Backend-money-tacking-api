<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Calculate wallet balance
    public function getBalanceAttribute()
    {
        return $this->transactions->reduce(function ($carry, $transaction) {
            return $transaction->type === 'income'
                ? $carry + $transaction->amount
                : $carry - $transaction->amount;
        }, 0);
    }
}

