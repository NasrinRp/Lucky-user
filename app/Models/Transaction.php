<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $table = 'transaction';

    protected $fillable = [
        'wallet_id',
        'amount',
        'transaction_type',
    ];

    public static array $transactionTypes = [
        'CREDIT' => 1,
        'DEBIT' => 2,
        'CODE' => 3,
    ];
}
