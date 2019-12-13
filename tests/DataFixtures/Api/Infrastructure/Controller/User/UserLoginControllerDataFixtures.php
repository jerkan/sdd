<?php


namespace App\Tests\DataFixtures\Api\Infrastructure\Controller\User;


use App\Domain\User\User;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserName;
use App\Domain\User\UserPassword;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class UserLoginControllerDataFixtures
 * @package App\Tests\DataFixtures\Api\Infrastructure\Controller\User
 */
class UserLoginControllerDataFixtures extends Fixture implements ContainerAwareInterface
{
    const USER_EMAIL = 'user2@mailinator.com';
    const USER_NAME = 'name';
    const USER_PASSWORD = 'password';
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');

        $password = self::USER_PASSWORD;

        $user = new User(
            UserId::next(),
            new UserEmail(self::USER_EMAIL),
            new UserPassword('dummy'),
            new UserName(self::USER_NAME)
        );
        $encodedPassword = $passwordEncoder->encodePassword($user, $password);
        $user->setPassword(new UserPassword($encodedPassword));

        $manager->persist($user);
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}