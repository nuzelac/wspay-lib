<?php

namespace WSPayLib;

class SignatureHelper
{

    protected $secretKey;

    /**
     * @param string $secretKey
     */
    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @param string $shopId
     * @param string $orderId
     * @param float $amount
     * @return string
     */
    public function calculateSignature($shopId, $orderId, $amount) {
        $amountForSignature = $this->cleanAmount($amount);

        return md5($shopId . $this->secretKey . $orderId . $this->secretKey . $amountForSignature . $this->secretKey);
    }

    public function calculateValidationSignature($shopId, $orderId, $success, $approvalCode) {
        return md5($shopId . $this->secretKey . $orderId . $this->secretKey . $success . $this->secretKey . $approvalCode . $this->secretKey);
    }

    public function isValidSignature($returnSignature, $shopId, $orderId, $success, $approvalCode) {
        return $returnSignature === $this->calculateValidationSignature($shopId, $orderId, $success, $approvalCode);
    }

    protected function cleanAmount($amount) {
        return number_format($amount, 2, '', '');
    }

}