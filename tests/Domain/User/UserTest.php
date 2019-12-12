<?php


namespace App\Tests\Domain\User;


use App\Domain\User\User;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserName;
use App\Domain\User\UserPassword;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package App\Tests\Domain\User
 */
class UserTest extends TestCase
{
    /**
     * @test
     */
    public function shouldInstantiateOk()
    {
        $faker = Factory::create();

        $name     = $faker->name;
        $email    = $faker->email;
        $password = $faker->password;

        $userId       = UserId::next();
        $userName     = new UserName($name);
        $userEmail    = new UserEmail($email);
        $userPassword = new UserPassword($password);

        $user = new User($userId, $userEmail, $userPassword, $userName);

        $this->assertEquals($userId, $user->id());
        $this->assertEquals($userName, $user->name());
        $this->assertEquals($userEmail, $user->email());
        $this->assertEquals($userPassword, $user->password());

        $this->assertSame($name, (string)$user->name());
        $this->assertSame($email, (string)$user->email());
        $this->assertSame($password, (string)$user->password());
    }
}