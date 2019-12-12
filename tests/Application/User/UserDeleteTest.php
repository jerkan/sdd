<?php


namespace App\Tests\Application\User;


use App\Application\User\UserDelete;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\UserRepository;
use App\Tests\Domain\User\UserMother;
use Faker\Factory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class UserDeleteTest
 * @package App\Tests\Application\User
 */
class UserDeleteTest extends TestCase
{
    /**
     * @var MockObject|UserRepository
     */
    private $repository;
    /**
     * @var \Faker\Generator
     */
    private $faker;

    protected function setUp()
    {
        $this->repository = $this->createMock(UserRepository::class);
        $this->faker = Factory::create();
    }

    /**
     * @test
     */
    public function shouldDeleteUser()
    {
        $user = UserMother::random();

        $this->repository
            ->method('ofId')
            ->willReturn($user);

        $this->repository
            ->expects($this->once())
            ->method('delete')
            ->with($user);

        $service = $this->getService();

        $service->execute($user->id());
    }

    /**
     * @test
     */
    public function shouldThrowWhenNotFound()
    {
        $this->expectException(UserNotFoundException::class);

        $user = UserMother::random();

        $service = $this->getService();

        $service->execute($user->id());
    }

    /**
     * @return UserDelete
     */
    private function getService()
    {
        return new UserDelete($this->repository);
    }
}