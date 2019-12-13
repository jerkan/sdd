<?php


namespace App\Shared\Application\User;

use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserName;
use App\Shared\Domain\User\UserPassword;

/**
 * Class UserAddCommand
 * @package App\Shared\Application\User
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