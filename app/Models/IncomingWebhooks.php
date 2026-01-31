<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingWebhooks extends Model
{
    /** @use HasFactory<\Database\Factories\IncomingWebhooksFactory> */
    use HasFactory;

    protected $fillable = [
        'bank',
        'payload',
        'status',
        'received_at',
        'processed_at',
    ];

    protected $casts = [
        // 'payload' => 'array',
    ];

    public $timestamps = false;

}
