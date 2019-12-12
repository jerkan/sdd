<?php


namespace App\Domain\User;


use Ramsey\Uuid\Uuid;

class UserId
{
    /**
     * @var string
     */
    private $id;

    /**
     * UserId constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return UserId
     * @throws \Exception
     */
    public static function next(): UserId
    {
        return new self(Uuid::uuid4());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id;
    }
}