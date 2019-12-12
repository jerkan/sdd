<?php


namespace App\Tests\Domain\User;


use App\Domain\User\UserPassword;
use Faker\Factory;

/**
 * Class UserPasswordMother
 * @package App\Tests\Domain\User
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