<?php


namespace App\Shared\Application\User;

use App\Shared\Domain\User\Exception\UserNotFoundException;
use App\Shared\Domain\User\User;
use App\Shared\Domain\User\UserRepository;

/**
 * Class UserUpdate
 * @package App\Shared\Application\User
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