<?php

namespace Aldijakaria\LaravelWallet\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ModelWallet extends Model
{
    protected $table = 'model_wallets';
    protected $fillable = ['balance', 'model_id', 'model_type', 'type'];

    public function transactions()
    {
        return $this->hasMany(ModelWalletTransaction::class)->orderBy('created_at', 'desc');
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

}
