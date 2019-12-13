<?php


namespace App\Tests\Shared\Domain\User;


use App\Shared\Domain\User\UserPassword;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

/**
 * Class UserPasswordTest
 * @package App\Tests\Shared\Domain\User
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