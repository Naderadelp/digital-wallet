<?php

namespace App\Transactions\DTO;

use App\Models\Transaction;

class TransactionDTO
{
    public ?string $date = null;
    public ?float $amount = null;
    public ?string $reference = null;
    public ?string $note = null;
    public ?string $internalReference = null;
    public ?string $bank = null;

    public function __construct(array $data = [])
    {
        $this->date = $data['date'] ?? null;
        $this->amount = $data['amount'] ?? null;
        $this->reference = $data['reference'] ?? null;
        $this->note = $data['note'] ?? null;
        $this->internalReference = $data['internalReference'] ?? null;
        $this->bank = $data['bank'] ?? null;
    }

    public function handle(): Transaction
    {
        $idempotency_key = md5($this->bank . '|' . $this->reference);
        dd($idempotency_key);
        return Transaction::create([
            'bank' => $this->bank ,
            'transaction_date' => $this->date,
            'amount' => $this->amount,
            'reference' => $this->reference,
            'internal_reference' => $this->internalReference,
            'note' => $this->note,
            'idempotency_key' => $idempotency_key,
        ]);
    }
}