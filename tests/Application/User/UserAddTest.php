<?php


namespace App\Tests\Application\User;


use App\Application\User\UserAdd;
use App\Application\User\UserAddCommand;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserName;
use App\Domain\User\UserPassword;
use App\Domain\User\UserRepository;
use App\Tests\Domain\User\UserEmailMother;
use App\Tests\Domain\User\UserNameMother;
use App\Tests\Domain\User\UserPasswordMother;
use Faker\Factory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserAddTest
 * @package App\Tests\Application\User
 */
class UserAddTest extends TestCase
{
    /**
     * @var MockObject|UserRepository
     */
    private $repository;
    /**
     * @var MockObject|UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;
    /**
     * @var \Faker\Generator
     */
    private $faker;

    protected function setUp()
    {
        $this->repository = $this->createMock(UserRepository::class);
        $this->userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $this->faker = Factory::create();
    }

    /**
     * @test
     */
    public function shouldAddUser()
    {
        $id            = UserId::next();
        $userEmail     = UserEmailMother::random();
        $plainPassword = 'password';
        $userName      = UserNameMother::random();

        $this->repository
            ->expects($this->once())
            ->method('save');

        $this->userPasswordEncoder
            ->method('encodePassword')
            ->willReturn($this->faker->password);
        
        $service = $this->getService();

        $command = $this->getCommand($id, $userEmail, $plainPassword, $userName);

        $user = $service->handle($command);

        $this->assertSame($id, $user->id());
        $this->assertSame($userEmail, $user->email());
        $this->assertSame($userName, $user->name());

        $this->assertNotNull($user->password());
    }

    /**
     * @return UserAdd
     */
    private function getService()
    {
        return new UserAdd(
            $this->repository,
            $this->userPasswordEncoder
        );
    }

    /**
     * @param UserId $id
     * @param UserEmail $userEmail
     * @param string $plainPassword
     * @param UserName $userName
     * @return UserAddCommand
     */
    private function getCommand(
        UserId $id,
        UserEmail $userEmail,
        string $plainPassword,
        UserName $userName
    )
    {
        return new UserAddCommand($id, $userEmail, $plainPassword, $userName);
    }
}