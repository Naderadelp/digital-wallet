<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'bank'              => $this->bank,
            'note'              => $this->note,
            'reference'         => $this->reference,
            'amount'            => $this->amount,
            'transaction_date'  => $this->transaction_date,
            'internal_reference'=> $this->internal_reference,
            'idempotency_key'   => $this->idempotency_key,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
