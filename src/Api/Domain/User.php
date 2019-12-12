<?php


namespace App\Api\Domain;


class User
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $name;

    /**
     * User constructor.
     * @param string $id
     * @param string $email
     * @param string $name
     */
    public function __construct(
        string $id,
        string $email,
        string $name
    )
    {
        $this->id    = $id;
        $this->email = $email;
        $this->name  = $name;
    }

    /**
     * @param \App\Domain\User\User $user
     * @return User
     */
    public static function fromUser(\App\Domain\User\User $user)
    {
        return new self(
            (string)$user->id(),
            (string)$user->email(),
            (string)$user->name()
        );
    }
}