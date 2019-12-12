<?php


namespace App\Domain\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Domain\User
 * @ORM\Entity(repositoryClass="App\Infrastructure\Persistence\Doctrine\Repository\DoctrineUserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="user_id")
     * @var UserId
     */
    private $id;
    /**
     * @ORM\Column(type="user_email")
     * @var UserEmail
     */
    private $email;
    /**
     * @ORM\Column(type="user_password")
     * @var UserPassword
     */
    private $password;
    /**
     * @ORM\Column(type="user_name")
     * @var UserName
     */
    private $name;

    /**
     * User constructor.
     * @param UserId $id
     * @param UserEmail $email
     * @param UserPassword $password
     * @param UserName $name
     */
    public function __construct(
        UserId $id,
        UserEmail $email,
        UserPassword $password,
        UserName $name
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
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
    public function email(): UserEmail
    {
        return $this->email;
    }

    /**
     * @return UserPassword
     */
    public function password(): UserPassword
    {
        return $this->password;
    }

    /**
     * @return UserName
     */
    public function name(): UserName
    {
        return $this->name;
    }

    /**
     * @param UserEmail $email
     */
    public function setEmail(UserEmail $email): void
    {
        $this->email = $email;
    }

    /**
     * @param UserPassword $password
     */
    public function setPassword(UserPassword $password): void
    {
        $this->password = $password;
    }

    /**
     * @param UserName $name
     */
    public function setName(UserName $name): void
    {
        $this->name = $name;
    }
}