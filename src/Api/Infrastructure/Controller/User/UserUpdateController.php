<?php


namespace App\Api\Infrastructure\Controller\User;


use App\Api\Domain\User;
use App\Shared\Application\User\UserUpdate;
use App\Shared\Application\User\UserUpdateCommand;
use App\Shared\Domain\User\UserEmail;
use App\Shared\Domain\User\UserId;
use App\Shared\Domain\User\UserName;
use Exception;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class UserUpdateController
 * @package App\Api\Infrastructure\Controller\User
 */
class UserUpdateController extends AbstractController
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var UserUpdate
     */
    private $userUpdate;

    /**
     * UserUpdateController constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param UserUpdate $userUpdate
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        UserUpdate $userUpdate
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->userUpdate = $userUpdate;
    }

    /**
     * @Route("/user", name="api_user_update", methods={"PATCH"})
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        try {

            $command = $this->createCommandFromRequest($request);

            $user = $this->userUpdate->handle($command);

            return $this->json([
                'user' => User::fromUser($user)
            ]);

        } catch (\InvalidArgumentException $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (Exception $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @return UserUpdateCommand
     */
    private function createCommandFromRequest(Request $request)
    {
        $requiredParameters = ['id'];

        $content = json_decode($request->getContent(), true);

        foreach ($requiredParameters as $requiredParameter) {
            if (empty($content[$requiredParameter])) {
                throw new InvalidArgumentException(sprintf(
                    'Missing required parameter "%s"', $requiredParameter
                ));
            }
        }

        $userEmail        = $content['email'] ? new UserEmail($content['email']) : null;
        $userName         = $content['name'] ? new UserName($content['name']) : null;
        $previousPassword = $content['previousPassword'] ?? null;
        $newPassword      = $content['newPassword'] ?? null;

        return new UserUpdateCommand(
            new UserId($content['id']),
            $userEmail,
            $userName,
            $previousPassword,
            $newPassword
        );
    }
}