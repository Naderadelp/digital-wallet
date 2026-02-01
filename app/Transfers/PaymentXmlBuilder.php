<?php

namespace App\Transfers;

use DOMDocument;

class PaymentXmlBuilder
{
    public function build(array $data): string
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->formatOutput = true;

        $root = $dom->createElement('PaymentRequestMessage');
        $dom->appendChild($root);

        // TransferInfo
        $transferInfo = $dom->createElement('TransferInfo');
        $root->appendChild($transferInfo);
        $transferInfo->appendChild($dom->createElement('Reference', $data['reference']));
        $transferInfo->appendChild($dom->createElement('Date', $data['date']));
        $transferInfo->appendChild($dom->createElement('Amount', $data['amount']));
        $transferInfo->appendChild($dom->createElement('Currency', $data['currency']));

        // SenderInfo
        $senderInfo = $dom->createElement('SenderInfo');
        $root->appendChild($senderInfo);
        $senderInfo->appendChild($dom->createElement('AccountNumber', $data['sender_account']));

        // ReceiverInfo
        $receiverInfo = $dom->createElement('ReceiverInfo');
        $root->appendChild($receiverInfo);
        $receiverInfo->appendChild($dom->createElement('BankCode', $data['receiver_bank_code']));
        $receiverInfo->appendChild($dom->createElement('AccountNumber', $data['receiver_account']));
        $receiverInfo->appendChild($dom->createElement('BeneficiaryName', $data['beneficiary_name']));

        // Notes
        $notesElement = $dom->createElement('Notes');
        $root->appendChild($notesElement);
        foreach ($data['notes'] ?? [] as $note) {
            $notesElement->appendChild($dom->createElement('Note', $note));
        }

        // PaymentType and ChargeDetails
        $root->appendChild($dom->createElement('PaymentType', $data['payment_type']));
        $root->appendChild($dom->createElement('ChargeDetails', $data['charge_details']));

        return $dom->saveXML();
    }
}
