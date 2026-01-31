<?php

namespace App\Http\Controllers;

use App\Jobs\IncomingWebHook;
use App\Models\IncomingWebhooks;
use App\Models\Transaction;
use App\Transactions\DTO\TransactionDTO;

class IncomingWebhooksController extends Controller
{
    public function __invoke($bank)
    {
        $payload = request()->input('payload');
        foreach($payload as $value){
            $incomingWebhook = IncomingWebhooks::create([
                'bank'        => $bank,
                'payload'     => $value,
                'status'      => 'recived',
                'received_at' => now(),
            ]);

            IncomingWebHook::dispatch($bank, json_encode($value), $incomingWebhook->id);
        }


        return response()->json(['status' => 'received'], 200);
    }
}
