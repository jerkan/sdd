<?php


namespace App\Tests\Application\User;


use App\Shared\Application\User\UserUpdate;
use App\Shared\Application\User\UserUpdateCommand;
use App\Shared\Domain\User\Exception\UserNotFoundException;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserName;
use App\Shared\Domain\User\UserPassword;
use App\Shared\Domain\User\UserRepository;
use App\Tests\Shared\Domain\User\UserEmailMother;
use App\Tests\Shared\Domain\User\UserMother;
use App\Tests\Shared\Domain\User\UserNameMother;
use App\Tests\Shared\Domain\User\UserPasswordMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

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


    protected function setUp()
    {
        $this->repository = $this->createMock(UserRepository::class);
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

        $userEmail    = UserEmailMother::random();
        $userPassword = UserPasswordMother::random();
        $userName     = UserNameMother::random();

        $command = $this->getCommand($user->id(), $userEmail, $userPassword, $userName);

        $userUpdated = $service->handle($command);

        $this->assertSame($user->id(), $userUpdated->id());
        $this->assertSame($userEmail, $userUpdated->email());
        $this->assertSame($userPassword, $userUpdated->password());
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

        $userEmail    = UserEmailMother::random();
        $userPassword = UserPasswordMother::random();
        $userName     = UserNameMother::random();

        $command = $this->getCommand($user->id(), $userEmail, $userPassword, $userName);

        $service->handle($command);
    }
    /**
     * @return UserUpdate
     */
    private function getService()
    {
        return new UserUpdate($this->repository);
    }

    /**
     * @param UserId $id
     * @param UserEmail $userEmail
     * @param UserPassword $userPassword
     * @param UserName $userName
     * @return UserUpdateCommand
     */
    private function getCommand(
        UserId $id,
        UserEmail $userEmail,
        UserPassword $userPassword,
        UserName $userName
    )
    {
        return new UserUpdateCommand(
            $id,
            $userEmail,
            $userPassword,
            $userName
        );
    }
}