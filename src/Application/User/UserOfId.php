<?php


namespace App\Application\User;


use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\UserRepository;

/**
 * Class UserOfId
 * @package App\Application\User
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