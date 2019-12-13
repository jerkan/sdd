<?php


namespace App\Tests\Shared\Domain\User;

use App\Shared\Domain\User\UserEmail;
use Faker\Factory;

/**
 * Class UserEmailMother
 * @package App\Tests\Shared\Domain\User
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