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
        // $lines = preg_split("/\r\n|\n|\r/", trim($payload));
        $lines = explode("#", trim($payload));
        dd($lines);
        $transactions = [];

        foreach ($lines as $line) {
          Log::info('Parsing line', [$line]);

            $parts = explode('#', $line);

            LOg::info('Parsed parts', [$parts]);


            [$amountPart, $reference , $metaPart] = $parts;
            Log::info('amount part',  [$amountPart]);
            Log::info('reference part',  [$reference]);
            Log::info('meta part',  [$metaPart]);

            $date   = substr($amountPart, 0, 8);
            $amount = str_replace(',', '.', substr($amountPart, 8));

            Log::info('Parsed date and amount', [$date , $amount]);

            $note = null;
            $internalReference = null;

            if ($metaPart) {
                $pairs = explode('/', $metaPart);

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
            ]);
        }
        Log::info('Parsed transactions', [$transactions]);

        return $transactions;
    }
}
