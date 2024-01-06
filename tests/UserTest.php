<?php


use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testReturnsFullName()
    {
        $user = new User();
        $user->first_name = 'Joe';
        $user->surname = 'Doe';

        $this->assertEquals('Joe Doe', $user->getFullName());
    }

    public function testFullNameIsEmptyByDefault()
    {
        $user = new User();
        $this->assertEquals('', $user->getFullName());
    }

    public function testUserHasFirstName()
    {
        $user = new User();
        $user->first_name = 'George';

        $this->assertEquals('George', $user->first_name);
    }

    public function testNotificationIsSent()
    {
        $user = new User();
        $mock_mailer = $this->createMock(Mailer::class);
        $mock_mailer->expects($this->once())
            ->method('sendMessage')
            ->with($this->equalTo('dev@test.com', $this->equalTo('Hello')))
            ->willReturn(true);

        $user->setMailer($mock_mailer);
        $user->email = 'dev@test.com';

        $this->assertTrue($user->notify('Hello'));
    }

    public function testCannotNotifyUserWithNoEmail()
    {
        $user = new User();
        $mock_mailer = $this->getMockBuilder(Mailer::class)
            ->setMethods(null)
            ->getMock();
        $user->setMailer($mock_mailer);
        $this->expectException(Exception::class);
        $user->notify('Hello');
    }
}
