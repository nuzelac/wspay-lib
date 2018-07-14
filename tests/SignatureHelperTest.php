<?php


class SignatureHelperTest extends \PHPUnit_Framework_TestCase
{

    public function testCalculateSignature()
    {
        $shopId = 'MYSHOP';
        $secretKey = '3DfEO2B5Jjm4VC1Q3vEh';
        $orderId = 78;
        $amount = 17.00;
        $expectedSignature = "590ea1de4c6ca66c2908dae58c083fa4";

        $helper = new \WSPayLib\SignatureHelper($secretKey);
        $calculatedSignature = $helper->calculateSignature($shopId, $orderId, $amount);

        $this->assertEquals($expectedSignature, $calculatedSignature);
    }
}
