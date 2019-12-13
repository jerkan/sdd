<?php


namespace App\Shared\Application\User;

use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserName;

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
     * @var UserEmail|null
     */
    private $userEmail;
    /**
     * @var UserName|null
     */
    private $userName;
    /**
     * @var string|null
     */
    private $previousPassword;
    /**
     * @var string|null
     */
    private $plainPassword;

    /**
     * UserUpdateCommand constructor.
     * @param UserId $id
     * @param UserEmail|null $userEmail
     * @param UserName|null $userName
     * @param string|null $previousPassword
     * @param string|null $plainPassword
     */
    public function __construct(
        UserId $id,
        UserEmail $userEmail = null,
        UserName $userName = null,
        string $previousPassword = null,
        string $plainPassword = null
    )
    {
        $this->id               = $id;
        $this->userEmail        = $userEmail;
        $this->userName         = $userName;
        $this->previousPassword = $previousPassword;
        $this->plainPassword    = $plainPassword;
    }

    /**
     * @return UserId
     */
    public function id(): UserId
    {
        return $this->id;
    }

    /**
     * @return UserEmail|null
     */
    public function userEmail(): ?UserEmail
    {
        return $this->userEmail;
    }

    /**
     * @return UserName|null
     */
    public function userName(): ?UserName
    {
        return $this->userName;
    }

    /**
     * @return string|null
     */
    public function previousPassword(): ?string
    {
        return $this->previousPassword;
    }

    /**
     * @return string|null
     */
    public function plainPassword(): ?string
    {
        return $this->plainPassword;
    }
}