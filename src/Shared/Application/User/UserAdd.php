<?php


namespace App\Shared\Application\User;

use App\Shared\Domain\User\User;
use App\Shared\Domain\User\UserPassword;
use App\Shared\Domain\User\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserAdd
 * @package App\Shared\Application\User
 */
class UserAdd
{
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserAdd constructor.
     * @param UserRepository $repository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        UserRepository $repository,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param UserAddCommand $command
     * @return User
     */
    public function handle(UserAddCommand $command)
    {
        $user = new User(
            $command->id(),
            $command->userEmail(),
            new UserPassword('dummy'),
            $command->userName()
        );

        $encodedPassword = $this->passwordEncoder->encodePassword($user, $command->plainPassword());
        $userPassword = new UserPassword($encodedPassword);
        $user->setPassword($userPassword);

        $this->repository->save($user);

        return $user;
    }
}