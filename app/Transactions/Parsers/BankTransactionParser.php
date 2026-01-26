<?php

namespace App\Transactions\Parsers;

use App\Transactions\DTO\TransactionDTO;

interface BankTransactionParser
{
    public function parse(string $data): array;
}