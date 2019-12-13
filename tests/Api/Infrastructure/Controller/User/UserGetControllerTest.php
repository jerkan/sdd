<?php


namespace App\Tests\Api\Infrastructure\Controller\User;


use App\Tests\Api\Infrastructure\Controller\ApiControllerWebTestCase;
use App\Tests\DataFixtures\Api\Infrastructure\Controller\User\UserGetControllerDataFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserGetControllerTest
 * @package App\Tests\Api\Infrastructure\Controller\User
 */
class UserGetControllerTest extends ApiControllerWebTestCase
{
    use FixturesTrait;

    protected function setUp(): void
    {
        $this->loadFixtures([
            UserGetControllerDataFixtures::class
        ]);
    }

    /**
     * @test
     * @group functional
     */
    public function shouldReturnUserData()
    {
        $client = $this->createAuthenticateClient(
            UserGetControllerDataFixtures::USER_EMAIL,
            UserGetControllerDataFixtures::USER_PASSWORD
        );

        $this->makeRequest($client);

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $content = $response->getContent();

        $json = json_decode($content, true);

        $this->assertArrayHasKey('user', $json);
        $this->assertArrayHasKey('id', $json['user']);
        $this->assertSame(UserGetControllerDataFixtures::USER_EMAIL, $json['user']['email']);
        $this->assertSame(UserGetControllerDataFixtures::USER_NAME, $json['user']['name']);
    }

    /**
     * @param KernelBrowser $client
     */
    private function makeRequest(KernelBrowser $client)
    {
        $client->request('GET', '/user',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );
    }
}