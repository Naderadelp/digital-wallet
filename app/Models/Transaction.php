<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'bank',
        'note',
        'reference',
        'amount',
        'transaction_date',
        'internal_reference',
        'idempotency_key'
    ];
}
