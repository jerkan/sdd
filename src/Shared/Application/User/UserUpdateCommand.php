<?php


namespace App\Shared\Application\User;

use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserName;
use App\Shared\Domain\User\UserPassword;

/**
 * Class UserUpdateCommand
 * @package App\Shared\Application\User
 */
class UserUpdateCommand
{
    /**
     * @var UserId
     */
    private $id;
    /**
     * @var UserEmail
     */
    private $userEmail;
    /**
     * @var UserPassword
     */
    private $userPassword;
    /**
     * @var UserName
     */
    private $userName;

    /**
     * UserUpdateCommand constructor.
     * @param UserId $id
     * @param UserEmail $userEmail
     * @param UserPassword $userPassword
     * @param UserName $userName
     */
    public function __construct(
        UserId $id,
        UserEmail $userEmail,
        UserPassword $userPassword,
        UserName $userName
    )
    {
        $this->id = $id;
        $this->userEmail = $userEmail;
        $this->userPassword = $userPassword;
        $this->userName = $userName;
    }

    /**
     * @return UserId
     */
    public function id(): UserId
    {
        return $this->id;
    }

    /**
     * @return UserEmail
     */
    public function userEmail(): UserEmail
    {
        return $this->userEmail;
    }

    /**
     * @return UserPassword
     */
    public function userPassword(): UserPassword
    {
        return $this->userPassword;
    }

    /**
     * @return UserName
     */
    public function userName(): UserName
    {
        return $this->userName;
    }
}