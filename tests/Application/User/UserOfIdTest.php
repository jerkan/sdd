<?php


namespace App\Tests\Application\User;


use App\Application\User\UserOfId;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\UserRepository;
use App\Tests\Domain\User\UserMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class UserOfIdTest
 * @package App\Tests\Application\User
 */
class UserOfIdTest extends TestCase
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
    public function shouldReturnUser()
    {
        $user = UserMother::random();

        $this->repository
            ->expects($this->once())
            ->method('ofId')
            ->willReturn($user);

        $service = $this->getService();

        $result = $service->execute($user->id());

        $this->assertSame($user, $result);
    }

    /**
     * @test
     */
    public function shouldThrowWhenNotFound()
    {
        $user = UserMother::random();

        $this->expectException(UserNotFoundException::class);

        $service = $this->getService();

        $service->execute($user->id());
    }

    /**
     * @return UserOfId
     */
    private function getService()
    {
        return new UserOfId($this->repository);
    }
}