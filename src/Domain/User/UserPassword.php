<?php


namespace App\Domain\User;


class UserPassword
{
    /**
     * @var string
     */
    private $password;

    /**
     * UserPassword constructor.
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->password;
    }
}