<?php


namespace App\Application\User;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserRepository;

/**
 * Class UserUpdate
 * @package App\Application\User
 */
class UserUpdate
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserUpdate constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserUpdateCommand $command
     * @return User
     * @throws UserNotFoundException
     */
    public function handle(UserUpdateCommand $command)
    {
        $user = $this->repository->ofId($command->id());

        if (!$user) {
            throw UserNotFoundException::ofId($command->id());
        }

        // TODO: validate email does not exists

        $user->setEmail($command->userEmail());
        $user->setPassword($command->userPassword());
        $user->setName($command->userName());

        $this->repository->save($user);

        return $user;
    }
}