<?php


namespace App\Tests\Domain\User;


use App\Domain\User\UserName;
use Faker\Factory;

/**
 * Class UserNameMother
 * @package App\Tests\Domain\User
 */
class UserNameMother
{
    /**
     * @return UserName
     */
    public static function random(): UserName
    {
        $faker = Factory::create();
        return new UserName($faker->name);
    }
}