<?php


namespace App\Tests\Shared\Domain\User;

use App\Shared\Domain\User\User;
use App\Shared\Domain\User\UserId;

/**
 * Class UserMother
 * @package App\Tests\Shared\Domain\User
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