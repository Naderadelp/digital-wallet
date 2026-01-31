<?php

namespace App\Transactions\Parsers;

use App\Transactions\DTO\TransactionDTO;
use Illuminate\Support\Facades\Log;

class AcmeParser implements BankTransactionParser
{
  public function parse(string $payload): array
  {
    Log::info('Parsing Acme payload', [$payload]);
    $lines = preg_split("/\r\n|\n|\r/", trim($payload));
    $transactions = [];

    foreach ($lines as $line) {
        Log::info('Parsing line', [$line]);

        $parts = explode('//', $line);

        Log::info('Parsed parts', [$parts]);

        [$amount , $reference , $date] = $parts;

        $transactions[] = new TransactionDTO([
            'date'              => $date,
            'amount'            => (float) $amount,
            'reference'         => $reference,
            'bank'              => 'Acme',
        ]);
    }
    Log::info('Parsed transactions', [$transactions]);

      return $transactions;
  }
}