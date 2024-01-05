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
        $mock_mailer->method('sendMessage')->willReturn(true);

        $user->setMailer($mock_mailer);
        $user->email = 'dev@test.com';

        $this->assertTrue($user->notify('Hello'));

    }
}
