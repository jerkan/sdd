<?php


namespace App\Tests\Domain\User;

use App\Domain\User\UserEmail;
use Faker\Factory;

/**
 * Class UserEmailMother
 * @package App\Tests\Domain\User
 */
class UserEmailMother
{
    /**
     * @return UserEmail
     */
    public static function random(): UserEmail
    {
        $faker = Factory::create();
        return new UserEmail($faker->email);
    }
}