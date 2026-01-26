<?php

namespace App\Transactions\DTO;

class TransactionDTO
{
    public ?string $date = null;
    public ?float $amount = null;
    public ?string $reference = null;
    public ?string $note = null;
    public ?string $internalReference = null;

    public function __construct(array $data = [])
    {
        $this->date = $data['date'] ?? null;
        $this->amount = $data['amount'] ?? null;
        $this->reference = $data['reference'] ?? null;
        $this->note = $data['note'] ?? null;
        $this->internalReference = $data['internalReference'] ?? null;
    }
}