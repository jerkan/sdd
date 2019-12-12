<?php


namespace App\Tests\Domain\User;

use App\Domain\User\User;
use App\Domain\User\UserId;

/**
 * Class UserMother
 * @package App\Tests\Domain\User
 */
class UserMother
{
    /**
     * @return User
     * @throws \Exception
     */
    public static function random(): User
    {
        return new User(
            UserId::next(),
            UserEmailMother::random(),
            UserPasswordMother::random(),
            UserNameMother::random()
        );
    }
}