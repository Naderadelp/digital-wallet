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
        $payload = request()->all();
        dd( $payload);

        $income = IncomingWebhooks::create([
            'bank' => $bank,
            'payload' => json_encode($payload),
            'status' => 'recived',
        ]);

        dispatch(new IncomingWebHook($bank, $payload , $income->id));

        return response()->json(['status' => 'received'], 200);
    }
}
