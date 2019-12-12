<?php


namespace App\Application\User;

use App\Domain\User\User;
use App\Domain\User\UserRepository;

/**
 * Class UserAdd
 * @package App\Application\User
 */
class UserAdd
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserAdd constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserAddCommand $command
     * @return User
     */
    public function handle(UserAddCommand $command)
    {
        $user = new User(
            $command->id(),
            $command->userEmail(),
            $command->userPassword(),
            $command->userName()
        );

        $this->repository->save($user);

        return $user;
    }
}