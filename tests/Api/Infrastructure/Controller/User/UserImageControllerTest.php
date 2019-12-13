<?php


namespace App\Tests\Api\Infrastructure\Controller\User;


use App\Tests\Api\Infrastructure\Controller\ApiControllerWebTestCase;
use App\Tests\DataFixtures\Api\Infrastructure\Controller\User\UserImageControllerDataFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserImageControllerTest
 * @package App\Tests\Api\Infrastructure\Controller\User
 */
class UserImageControllerTest extends ApiControllerWebTestCase
{
    use FixturesTrait;

    protected function setUp(): void
    {
        $this->loadFixtures([
            UserImageControllerDataFixtures::class
        ]);
    }

    /**
     * @test
     * @group functional
     */
    public function shouldCreateUserImage()
    {
        $client = $this->createAuthenticateClient(
            UserImageControllerDataFixtures::USER_EMAIL,
            UserImageControllerDataFixtures::USER_PASSWORD
        );

        $this->makeRequest($client);

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $content = $response->getContent();

        $json = json_decode($content, true);

        $this->assertArrayHasKey('image', $json);
    }

    /**
     * @param KernelBrowser $client
     */
    private function makeRequest(KernelBrowser $client)
    {
        $client->request('GET', '/user/image',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );
    }
}