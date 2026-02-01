<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reference'          => 'required|string',
            'date'               => 'required|string',
            'amount'             => 'required|numeric',
            'currency'           => 'required|string',
            'sender_account'     => 'required|string',
            'receiver_bank_code' => 'required|string',
            'receiver_account'   => 'required|string',
            'beneficiary_name'   => 'required|string',
            'notes'              => 'sometimes|array',
            'notes.*'            => 'string',
            'payment_type'       => 'required|integer',
            'charge_details'     => 'required|string',
        ];
    }
}
