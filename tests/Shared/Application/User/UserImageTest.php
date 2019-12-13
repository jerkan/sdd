<?php


namespace App\Tests\Shared\Application\User;

use App\Shared\Application\User\UserImage;
use App\Shared\Application\User\UserImageRepository;
use App\Shared\Domain\User\UserRepository;
use App\Tests\Shared\Domain\User\UserMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class UserImageTest
 * @package App\Tests\Shared\Application\User
 */
class UserImageTest extends TestCase
{
    /**
     * @var MockObject|UserImageRepository
     */
    private $userImageRepository;
    /**
     * @var MockObject|UserRepository
     */
    private $userRepository;

    protected function setUp()
    {
        $this->userImageRepository = $this->createMock(UserImageRepository::class);
        $this->userRepository = $this->createMock(UserRepository::class);
    }

    /**
     * @test
     */
    public function shouldReturnImageUrl()
    {
        $user = UserMother::random();
        $imageUrl = '/';

        $this->userRepository
            ->method('ofId')
            ->willReturn($user);

        $this->userImageRepository
            ->method('ofUser')
            ->willReturn($imageUrl);

        $service = $this->getService();

        $result = $service->execute($user->id());

        $this->assertSame($imageUrl, $result);
    }

    /**
     * @return UserImage
     */
    private function getService()
    {
        return new UserImage(
            $this->userImageRepository,
            $this->userRepository
        );
    }
}