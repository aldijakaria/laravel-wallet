<?php

namespace Aldijakaria\LaravelWallet;

use Aldijakaria\LaravelWallet\Models\ModelWallet;
use Aldijakaria\LaravelWallet\Models\ModelWalletTransaction;
use Illuminate\Database\Eloquent\Model;

trait HasWallet
{
    public function getBalance($type = 'USD') : float
    {
        $wallet = $this->wallet->where('type', $type)->first();

        if ($wallet == null) {
            $wallet = $this->wallet()->create([
                'balance' => 0,
                'type' => $type,
            ]);
        }
        $new = $wallet;

        return $new->balance;
    }

    public function credit($amount, $comment, Model $relational, $type = 'USD') : ModelWalletTransaction
    {
        $prev_balance = $this->getBalance($type);

        $wallet = $this->wallet()->where('type', $type)->first();
        $wallet->balance = $wallet->balance + $amount;
        $wallet->save();

        $transaction = $wallet->transactions()->create([
            'amount' => $amount,
            'balance' => $wallet->balance,
            'prev_balance' => $prev_balance,
            'comment' => $comment,
            'type' => ModelWalletTransaction::CREDIT,
            'transaction_type' => get_class($relational),
            'transaction_id' => $relational->getKey(),
        ]);

        return $transaction;
    }

    public function debit($amount, $comment, Model $relational, $type = 'USD') : ModelWalletTransaction
    {
        $prev_balance = $this->getBalance($type);

        $wallet = $this->wallet()->where('type', $type)->first();
        $wallet->balance = $wallet->balance - $amount;
        $wallet->save();

        $transaction = $wallet->transactions()->create([
            'amount' => -$amount,
            'balance' => $wallet->balance,
            'prev_balance' => $prev_balance,
            'comment' => $comment,
            'type' => ModelWalletTransaction::DEBIT,
            'transaction_type' => get_class($relational),
            'transaction_id' => $relational->getKey(),
        ]);

        return $transaction;
    }

    public function wallet()
    {
        return $this->morphMany(ModelWallet::class, 'model');
    }

}
