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

    protected function setUp()
    {
        $this->repository = $this->createMock(UserRepository::class);
        $faker = Factory::create();
    }

    /**
     * @test
     */
    public function shouldAddUser()
    {
        $id           = UserId::next();
        $userEmail    = UserEmailMother::random();
        $userPassword = UserPasswordMother::random();
        $userName     = UserNameMother::random();

        $this->repository
            ->expects($this->once())
            ->method('save');

        $service = $this->getService();

        $command = $this->getCommand($id, $userEmail, $userPassword, $userName);

        $user = $service->handle($command);

        $this->assertSame($id, $user->id());
        $this->assertSame($userEmail, $user->email());
        $this->assertSame($userPassword, $user->password());
        $this->assertSame($userName, $user->name());
    }

    /**
     * @return UserAdd
     */
    private function getService()
    {
        return new UserAdd($this->repository);
    }

    /**
     * @param UserId $id
     * @param UserEmail $userEmail
     * @param UserPassword $userPassword
     * @param UserName $userName
     * @return UserAddCommand
     */
    private function getCommand(
        UserId $id,
        UserEmail $userEmail,
        UserPassword $userPassword,
        UserName $userName
    )
    {
        return new UserAddCommand($id, $userEmail, $userPassword, $userName);
    }
}