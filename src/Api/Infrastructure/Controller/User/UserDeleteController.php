<?php


namespace App\Api\Infrastructure\Controller\User;


use App\Shared\Application\User\UserDelete;
use App\Shared\Domain\User\Exception\UserNotFoundException;
use App\Shared\Domain\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class UserDeleteController
 * @package App\Api\Infrastructure\Controller\User
 */
class UserDeleteController extends AbstractController
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var UserDelete
     */
    private $userDelete;

    /**
     * UserDeleteController constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param UserDelete $userDelete
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        UserDelete $userDelete
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->userDelete = $userDelete;
    }

    /**
     * @Route("/user", name="api_user_delete", methods={"DELETE"})
     */
    public function delete()
    {
        try {
            /** @var User $user */
            $user = $this->tokenStorage->getToken()->getUser();

            $this->userDelete->execute($user->id());

            return $this->json([]);

        } catch (UserNotFoundException $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (\Exception $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}