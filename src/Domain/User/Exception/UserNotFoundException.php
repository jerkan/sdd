<?php


namespace App\Domain\User\Exception;


use App\Domain\User\UserId;

/**
 * Class UserNotFoundException
 * @package App\Domain\User\Exception
 */
class UserNotFoundException extends \Exception
{
    /**
     * @param UserId $id
     * @return UserNotFoundException
     */
    public static function ofId(UserId $id)
    {
        return new self(sprintf(
            'User with id "%s" not found', $id
        ));
    }
}