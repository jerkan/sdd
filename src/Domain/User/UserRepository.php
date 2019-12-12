<?php


namespace App\Domain\User;


interface UserRepository
{
    /**
     * @param User $user
     */
    public function save(User $user): void;

    /**
     * @param UserId $id
     * @return User|null
     */
    public function ofId(UserId $id): ?User;

    /**
     * @param User $user
     */
    public function delete(User $user): void;
}