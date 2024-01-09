<?php


use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testOrderIsProcessedUsingMock()
    {
        $order = new Order(3, 1.99);
        $this->assertEquals(5.97, $order->amount);

        $gatewayMock = Mockery::mock('PaymentGateway');
        $gatewayMock->shouldReceive('charge')
                    ->once()
                    ->with(5.97);
        $order->process($gatewayMock);
    }
    public function testOrderIsProcessedUsingSpy()
    {
        $order = new Order(3, 1.99);
        $this->assertEquals(5.97, $order->amount);

        $gatewaySpy = Mockery::spy('PaymentGateway');
        $order->process($gatewaySpy);

        $gatewaySpy->shouldHaveReceived('charge')
                    ->once()
                    ->with(5.97);
    }
}
