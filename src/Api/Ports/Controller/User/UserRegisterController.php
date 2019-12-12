<?php


namespace App\Api\Ports\Controller\User;


use App\Api\Domain\User;
use App\Application\User\UserAdd;
use App\Application\User\UserAddCommand;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserName;
use App\Domain\User\UserPassword;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserRegisterController
 * @package App\Api\Ports\Controller\User
 */
class UserRegisterController extends AbstractController
{
    /**
     * @var UserAdd
     */
    private $userAdd;

    /**
     * UserRegisterController constructor.
     * @param UserAdd $userAdd
     */
    public function __construct(UserAdd $userAdd)
    {
        $this->userAdd = $userAdd;
    }

    /**
     * @Route("/api/user", name="api_user_register", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        try {

            $command = $this->createCommandFromRequest($request);

            $user = $this->userAdd->handle($command);

            return $this->json(['user' => User::fromUser($user)]);

        } catch (\InvalidArgumentException $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (Exception $exception) {
            // TODO: log exception
            return $this->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @return UserAddCommand
     * @throws Exception
     */
    private function createCommandFromRequest(Request $request)
    {
        $requiredParameters = ['email', 'password', 'name'];

        foreach ($requiredParameters as $requiredParameter) {
            if (!$request->get($requiredParameter)) {
                throw new \InvalidArgumentException(sprintf(
                    'Missing required parameter "%s"', $requiredParameter
                ));
            }
        }
        return new UserAddCommand(
            UserId::next(),
            new UserEmail($request->get('email')),
            new UserPassword($request->get('password')),
            new UserName($request->get('name'))
        );
    }
}