<?php


namespace App\Tests\Application\User;


use App\Shared\Application\User\UserUpdate;
use App\Shared\Application\User\UserUpdateCommand;
use App\Shared\Domain\User\Exception\UserNotFoundException;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserName;
use App\Shared\Domain\User\UserRepository;
use App\Tests\Shared\Domain\User\UserEmailMother;
use App\Tests\Shared\Domain\User\UserMother;
use App\Tests\Shared\Domain\User\UserNameMother;
use App\Tests\Shared\Domain\User\UserPasswordMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserUpdateTest
 * @package App\Tests\Application\User
 */
class UserUpdateTest extends TestCase
{
    /**
     * @var MockObject|UserRepository
     */
    private $repository;
    /**
     * @var MockObject|UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    protected function setUp()
    {
        $this->repository = $this->createMock(UserRepository::class);
        $this->passwordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
    }

    /**
     * @test
     */
    public function shouldUpdateUser()
    {
        $user = UserMother::random();

        $this->repository
            ->expects($this->once())
            ->method('ofId')
            ->willReturn($user);

        $this->repository
            ->expects($this->once())
            ->method('save')
            ->with($user);

        $service = $this->getService();

        $userEmail = UserEmailMother::random();
        $userName  = UserNameMother::random();

        $command = $this->getCommand($user->id(), $userEmail, $userName);

        $userUpdated = $service->handle($command);

        $this->assertSame($user->id(), $userUpdated->id());
        $this->assertSame($userEmail, $userUpdated->email());
        $this->assertSame($userName, $userUpdated->name());
    }

    /**
     * @test
     */
    public function shouldThrowWhenUserNotFound()
    {
        $this->expectException(UserNotFoundException::class);

        $user = UserMother::random();

        $service = $this->getService();

        $userEmail = UserEmailMother::random();
        $userName  = UserNameMother::random();

        $command = $this->getCommand($user->id(), $userEmail, $userName);

        $service->handle($command);
    }
    /**
     * @return UserUpdate
     */
    private function getService()
    {
        return new UserUpdate(
            $this->repository,
            $this->passwordEncoder
        );
    }

    /**
     * @param UserId $id
     * @param UserEmail|null $userEmail
     * @param UserName|null $userName
     * @param string|null $previousPassword
     * @param string|null $plainPassword
     * @return UserUpdateCommand
     */
    private function getCommand(
        UserId $id,
        ?UserEmail $userEmail,
        ?UserName $userName,
        string $previousPassword = null,
        string $plainPassword = null
    )
    {
        return new UserUpdateCommand(
            $id,
            $userEmail,
            $userName,
            $previousPassword,
            $plainPassword
        );
    }
}