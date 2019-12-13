<?php


namespace App\Api\Infrastructure\Controller\User;


use App\Shared\Application\User\UserOfId;
use App\Shared\Domain\User\User;
use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class UserGetController
 * @package App\Api\Infrastructure\Controller\User
 */
class UserGetController extends AbstractController
{
    /**
     * @var UserOfId
     */
    private $userOfId;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * UserGetController constructor.
     * @param UserOfId $userOfId
     * @param TokenStorageInterface $token
     */
    public function __construct(
        UserOfId $userOfId,
        TokenStorageInterface $token
    )
    {
        $this->userOfId = $userOfId;
        $this->tokenStorage = $token;
    }

    /**
     * @Route("/user", name="api_user_get", methods={"GET"})
     */
    public function getUserInfo()
    {
        try {
            /** @var User $user */
            $user = $this->tokenStorage->getToken()->getUser();

            return $this->json([
                'user' => \App\Api\Domain\User::fromUser($user)
            ]);

        } catch (Exception $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}