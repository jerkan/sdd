<?php


namespace App\Tests\Shared\Domain\User;


use App\Shared\Domain\User\UserName;
use Faker\Factory;

/**
 * Class UserNameMother
 * @package App\Tests\Shared\Domain\User
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