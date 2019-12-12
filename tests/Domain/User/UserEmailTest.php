<?php


namespace App\Tests\Domain\User;


use App\Domain\User\UserEmail;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

/**
 * Class UserEmailTest
 * @package App\Tests\Domain\User
 */
class UserEmailTest extends TestCase
{
    /**
     * @test
     */
    public function shouldInstantiateOk()
    {
        $faker = Factory::create();

        $email = $faker->email;

        $userEmail = new UserEmail($email);

        $this->assertSame($email, $userEmail->email());
    }

    /**
     * @test
     */
    public function shouldThrowOnInvalidEmail()
    {
        $this->expectException(\InvalidArgumentException::class);

        new UserEmail('non-valid-email-address');
    }
}