<?php


namespace App\Tests\Domain\User;


use App\Domain\User\UserPassword;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

/**
 * Class UserPasswordTest
 * @package App\Tests\Domain\User
 */
class UserPasswordTest extends TestCase
{
    /**
     * @test
     */
    public function shouldInstantiateOk()
    {
        $faker = Factory::create();

        $password = $faker->password;

        $userPassword = new UserPassword($password);

        $this->assertSame($password, (string)$userPassword);
    }
}