<?php


namespace App\Tests\Shared\Domain\User;


use App\Shared\Domain\User\UserPassword;
use Faker\Factory;

/**
 * Class UserPasswordMother
 * @package App\Tests\Shared\Domain\User
 */
class UserPasswordMother
{
    /**
     * @return UserPassword
     */
    public static function random(): UserPassword
    {
        $faker = Factory::create();
        return new UserPassword($faker->password);
    }
}