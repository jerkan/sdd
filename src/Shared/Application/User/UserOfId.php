<?php


namespace App\Shared\Application\User;


use App\Shared\Domain\User\Exception\UserNotFoundException;
use App\Shared\Domain\User\User;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserRepository;

/**
 * Class UserOfId
 * @package App\Shared\Application\User
 */
class UserOfId
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserOfId constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserId $id
     * @return User
     * @throws UserNotFoundException
     */
    public function execute(UserId $id)
    {
        $user = $this->repository->ofId($id);

        if (!$user) {
            throw UserNotFoundException::ofId($id);
        }

        return $user;
    }
}