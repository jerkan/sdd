<?php


namespace App\Shared\Application\User;

use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserRepository;

/**
 * Class UserImage
 * @package App\Shared\Application\User
 */
class UserImage
{
    /**
     * @var UserImageRepository
     */
    private $userImageRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserImage constructor.
     * @param UserImageRepository $userImageRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserImageRepository $userImageRepository,
        UserRepository $userRepository
    )
    {
        $this->userImageRepository = $userImageRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserId $userId
     * @return string
     */
    public function execute(UserId $userId)
    {
        $user = $this->userRepository->ofId($userId);

        return $this->userImageRepository->ofUser($user);
    }
}