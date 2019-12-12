<?php


namespace App\Tests\Domain\User;


use App\Domain\User\UserName;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

/**
 * Class UserNameTest
 * @package App\Tests\Domain\User
 */
class UserNameTest extends TestCase
{
    /**
     * @test
     */
    public function shouldInstantiateOk()
    {
        $faker = Factory::create();

        $name = $faker->name;

        $userName = new UserName($name);

        $this->assertSame($name, (string)$userName);
    }
}