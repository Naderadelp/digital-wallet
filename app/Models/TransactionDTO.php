<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDTO extends Model
{
    protected $fillable = [
        'amount',
        'reference',
        'transaction_date',
        'raw_line',
        'currency',
        'bank',
    ];
}
