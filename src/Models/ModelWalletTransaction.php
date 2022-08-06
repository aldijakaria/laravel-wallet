<?php

namespace Aldijakaria\LaravelWallet\Models;

use Illuminate\Database\Eloquent\Model;

class ModelWalletTransaction extends Model
{
    protected $table = 'model_wallet_transactions';

    const CREDIT = 'Credit';
    const DEBIT = 'Debit';

    protected $fillable = ['model_wallet_id', 'amount', 'comment', 'balance', 'prev_balance', 'type', 'transaction_type', 'transaction_id'];

    public function wallet()
    {
        return $this->belongsTo(ModelWallet::class, 'model_wallet_id');
    }
}
