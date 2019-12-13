<?php


namespace App\Shared\Application\User;


use App\Shared\Domain\User\Exception\UserNotFoundException;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserRepository;

class UserDelete
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserDelete constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserId $id
     * @throws UserNotFoundException
     */
    public function execute(UserId $id)
    {
        $user = $this->repository->ofId($id);

        if (!$user) {
            throw UserNotFoundException::ofId($id);
        }

        $this->repository->delete($user);
    }
}