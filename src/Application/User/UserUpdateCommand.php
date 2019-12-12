<?php


namespace App\Application\User;

use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserName;
use App\Domain\User\UserPassword;

/**
 * Class UserUpdateCommand
 * @package App\Application\User
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