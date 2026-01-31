<?php

namespace App\Transactions\Parsers;

use App\Transactions\DTO\TransactionDTO;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class PayTechParser implements BankTransactionParser
{
    public function parse(string $payload): array
    {
      Log::info('Parsing PayTech payload', [$payload]);
        $lines = preg_split("/\r\n|\n|\r/", trim($payload));
        $transactions = [];

        foreach ($lines as $line) {
          Log::info('Parsing line', [$line]);

            $parts = explode('#', $line);

            LOg::info('Parsed parts', [$parts]);


            [$part1, $reference , $part3] = $parts;
            Log::info('amount part',  [$part1]);
            Log::info('reference part',  [$reference]);
            Log::info('meta part',  [$part3]);

            $date = substr($part1, 0, 8);
            $amount = (float) str_replace(',', '.', substr($part1, 8));

            Log::info('Parsed date and amount', [$date , $amount]);

            if ($part3) {
                $pairs = explode('/', $part3);

                for ($i = 0; $i < count($pairs); $i += 2) {
                    if ($pairs[$i] === 'note') {
                        $note = $pairs[$i + 1];
                    }

                    if ($pairs[$i] === 'internal_reference') {
                        $internalReference = $pairs[$i + 1];
                    }
                }
            }

            $transactions[] = new TransactionDTO([
                'date'              => $date,
                'amount'            => (float) $amount,
                'reference'         => $reference,
                'note'              => $note,
                'internalReference' => $internalReference,
                'bank'              => 'PayTech',
            ]);
        }
        Log::info('Parsed transactions', [$transactions]);

        return $transactions;
    }
}
