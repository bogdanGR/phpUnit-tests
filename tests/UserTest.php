<?php


use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testReturnsFullName()
    {
        require 'User.php';

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
}
