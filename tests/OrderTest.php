<?php


use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testOrderInProcessed()
    {
        // we can create mock of non-existing class
        // use getMockBuilder instead
        $gateway = $this->getMockBuilder('PaymentGateway')
            ->setMethods(['charge'])
            ->getMock();

        $gateway->expects($this->once())
            ->method('charge')
            ->with($this->equalTo(250))
            ->willReturn(true);

        $order = new Order($gateway);
        $order->amount = 250;
        $this->assertTrue($order->process());
    }
}
