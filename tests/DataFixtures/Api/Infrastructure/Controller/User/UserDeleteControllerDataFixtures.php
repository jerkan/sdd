<?php


namespace App\Tests\DataFixtures\Api\Infrastructure\Controller\User;


use App\Shared\Domain\User\User;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserName;
use App\Shared\Domain\User\UserPassword;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class UserDeleteControllerDataFixtures
 * @package App\Tests\DataFixtures\Api\Infrastructure\Controller\User
 */
class UserDeleteControllerDataFixtures extends Fixture implements ContainerAwareInterface
{
    const USER_ID = '2ee412eb-f0dc-4503-a415-07ed2bd48b22';
    const USER_EMAIL = 'user@mailinator.com';
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
            new UserId(self::USER_ID),
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