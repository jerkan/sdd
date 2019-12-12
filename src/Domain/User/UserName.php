<?php


namespace App\Domain\User;


class UserName
{
    /**
     * @var string
     */
    private $name;

    /**
     * UserName constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}