<?php


namespace App\Tests\Api\Infrastructure\Controller\User;


use App\Tests\Api\Infrastructure\Controller\ApiControllerWebTestCase;
use App\Tests\DataFixtures\Api\Infrastructure\Controller\User\UserLoginControllerDataFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserLoginControllerTest
 * @package App\Tests\Api\Infrastructure\Controller\User
 */
class UserLoginControllerTest extends ApiControllerWebTestCase
{
    use FixturesTrait;

    protected function setUp(): void
    {
        $this->loadFixtures([
            UserLoginControllerDataFixtures::class
        ]);
    }

    /**
     * @test
     */
    public function shouldLoginOk()
    {
        $client = $this->createAuthenticateClient(
            UserLoginControllerDataFixtures::USER_EMAIL,
            UserLoginControllerDataFixtures::USER_PASSWORD
        );

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $content = $response->getContent();

        $json = json_decode($content, true);

        $this->assertArrayHasKey('token', $json);
        $this->assertNotNull($json['token']);
    }
}