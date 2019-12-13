<?php


namespace App\Tests\Api\Infrastructure\Controller\User;


use App\Tests\Api\Infrastructure\Controller\ApiControllerWebTestCase;
use App\Tests\DataFixtures\Api\Infrastructure\Controller\User\UserDeleteControllerDataFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserDeleteControllerTest
 * @package App\Tests\Api\Infrastructure\Controller\User
 */
class UserDeleteControllerTest extends ApiControllerWebTestCase
{
    use FixturesTrait;

    protected function setUp(): void
    {
        $this->loadFixtures([
            UserDeleteControllerDataFixtures::class
        ]);
    }

    /**
     * @test
     * @group functional
     */
    public function shouldDeleteUser()
    {
        $client = $this->createAuthenticateClient(
            UserDeleteControllerDataFixtures::USER_EMAIL,
            UserDeleteControllerDataFixtures::USER_PASSWORD
        );

        $this->makeRequest($client);

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @param KernelBrowser $client
     */
    private function makeRequest(KernelBrowser $client)
    {
        $client->request('DELETE', '/user');
    }
}