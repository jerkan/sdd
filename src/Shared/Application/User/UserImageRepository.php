<?php


namespace App\Shared\Application\User;


use App\Shared\Domain\User\User;

interface UserImageRepository
{
    /**
     * @param User $user
     * @return string
     */
    public function ofUser(User $user): string;
}