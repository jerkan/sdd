<?php


namespace App\Tests\DataFixtures\Api\Ports\Controller\User;


use App\Domain\User\User;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserName;
use App\Domain\User\UserPassword;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserLoginControllerDataFixtures extends Fixture
{
    const USER_EMAIL = 'user@mailinator.com';
    const USER_NAME = 'name';
    const USER_PASSWORD = 'password';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $password = self::USER_PASSWORD;
        $encodedPassword = sha1($password);

        $user = new User(
            UserId::next(),
            new UserEmail(self::USER_EMAIL),
            new UserPassword($encodedPassword),
            new UserName(self::USER_NAME)
        );
        $manager->persist($user);
        $manager->flush();
    }
}