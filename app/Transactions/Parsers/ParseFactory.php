<?php

namespace App\Transactions\Parsers;

use App\Transactions\Parsers\BankTransactionParser;
use App\Transactions\Parsers\PayTechParser;
use App\Transactions\Parsers\AcmeParser;


class ParseFactory
{
    public static function make(string $bank): BankTransactionParser
    {
        $bank = strtolower(trim($bank));
        
        return match ($bank) {
            'paytech' => new PayTechParser(),
            'acme'    => new AcmeParser(),
        };
    }

}