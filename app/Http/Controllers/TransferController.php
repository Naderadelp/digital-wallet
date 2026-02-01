<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest;
use App\Transfers\PaymentXmlBuilder;

class TransferController extends Controller
{
    public function __invoke(TransferRequest $request)
    {
        $xml = (new PaymentXmlBuilder())->build($request->validated());

        return response($xml, 200);
    }
}
