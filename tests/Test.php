<?php


use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testMock()
    {
        $mock = $this->createMock(Mailer::class);
        $mock->method('sendMessage')
            ->willReturn(true);
        $result = $mock->sendMessage('dev@test.com', 'Hello');

        $this->assertTrue($result);
    }
}
