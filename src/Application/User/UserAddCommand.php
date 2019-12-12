<?php


namespace App\Application\User;

use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserName;
use App\Domain\User\UserPassword;

/**
 * Class UserAddCommand
 * @package App\Application\User
 */
class UserAddCommand
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
     * @var UserName
     */
    private $userName;
    /**
     * @var string
     */
    private $plainPassword;

    /**
     * UserAddCommand constructor.
     * @param UserId $id
     * @param UserEmail $userEmail
     * @param string $plainPassword
     * @param UserName $userName
     */
    public function __construct(
        UserId $id,
        UserEmail $userEmail,
        string $plainPassword,
        UserName $userName
    )
    {
        $this->id = $id;
        $this->userEmail = $userEmail;
        $this->plainPassword = $plainPassword;
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
     * @return string
     */
    public function plainPassword(): string
    {
        return $this->plainPassword;
    }

    /**
     * @return UserName
     */
    public function userName(): UserName
    {
        return $this->userName;
    }
}