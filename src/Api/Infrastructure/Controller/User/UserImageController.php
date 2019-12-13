<?php


namespace App\Api\Infrastructure\Controller\User;


use App\Shared\Application\User\UserImage;
use App\Shared\Domain\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class UserImageController
 * @package App\Api\Infrastructure\Controller\User
 */
class UserImageController extends AbstractController
{
    /**
     * @var UserImage
     */
    private $userImage;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * UserImageController constructor.
     * @param UserImage $userImage
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        UserImage $userImage,
        TokenStorageInterface $tokenStorage
    )
    {
        $this->userImage = $userImage;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/user/image", name="api_user_image", methods={"GET"})
     */
    public function image()
    {
        try {
            /** @var User $user */
            $user = $this->tokenStorage->getToken()->getUser();

            $imageUrl = $this->userImage->execute($user->id());

            return $this->json(['image' => $imageUrl]);

        } catch (\Exception $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}