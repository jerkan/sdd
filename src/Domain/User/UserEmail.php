<?php


namespace App\Domain\User;

/**
 * Class UserEmail
 * @package App\Domain\User
 */
class UserEmail
{
    /**
     * @var string
     */
    private $email;

    /**
     * UserEmail constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->assertValidEmail($email);
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    private function assertValidEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid email address "%s"', $email
            ));
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->email;
    }
}