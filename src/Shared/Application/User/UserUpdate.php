<?php


namespace App\Shared\Application\User;

use App\Shared\Domain\User\Exception\UserNotFoundException;
use App\Shared\Domain\User\User;
use App\Shared\Domain\User\UserPassword;
use App\Shared\Domain\User\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserUpdate
 * @package App\Shared\Application\User
 */
class UserUpdate
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
     * UserUpdate constructor.
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
     * @param UserUpdateCommand $command
     * @return User
     * @throws UserNotFoundException
     */
    public function handle(UserUpdateCommand $command)
    {
        $user = $this->repository->ofId($command->id());

        if (!$user) {
            throw UserNotFoundException::ofId($command->id());
        }

        // TODO: validate email does not exists


        if ($command->userEmail()) {
            $user->setEmail($command->userEmail());
        }

        if ($command->userEmail()) {
            $user->setName($command->userName());
        }

        if ($command->previousPassword() && $command->plainPassword()) {

            if (!$this->passwordEncoder->isPasswordValid($user, $command->previousPassword())) {
                throw new \InvalidArgumentException(sprintf(
                    'Invalid current password'
                ));
            }
            $encodedPassword = $this->passwordEncoder->encodePassword($user, $command->plainPassword());
            $user->setPassword(new UserPassword($encodedPassword));
        }

        $this->repository->save($user);

        return $user;
    }
}