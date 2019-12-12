<?php


namespace App\Domain\User;


interface UserRepository
{
    /**
     * @param User $user
     */
    public function save(User $user): void;
}