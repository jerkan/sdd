<?php


namespace App\Tests\Application\User;


use App\Application\User\UserUpdate;
use App\Application\User\UserUpdateCommand;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserName;
use App\Domain\User\UserPassword;
use App\Domain\User\UserRepository;
use App\Tests\Domain\User\UserEmailMother;
use App\Tests\Domain\User\UserMother;
use App\Tests\Domain\User\UserNameMother;
use App\Tests\Domain\User\UserPasswordMother;
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