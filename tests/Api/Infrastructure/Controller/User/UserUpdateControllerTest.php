<?php


namespace App\Tests\Api\Infrastructure\Controller\User;


use App\Tests\Api\Infrastructure\Controller\ApiControllerWebTestCase;
use App\Tests\DataFixtures\Api\Infrastructure\Controller\User\UserUpdateControllerDataFixtures;
use Faker\Factory;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserUpdateControllerTest
 * @package App\Tests\Api\Infrastructure\Controller\User
 */
class UserUpdateControllerTest extends ApiControllerWebTestCase
{
    use FixturesTrait;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    protected function setUp()
    {
        $this->loadFixtures([
            UserUpdateControllerDataFixtures::class
        ]);
        $this->faker = Factory::create();
    }

    /**
     * @test
     * @group functional
     */
    public function shouldUpdateUser()
    {
        $client = $this->createAuthenticateClient(
            UserUpdateControllerDataFixtures::USER_EMAIL,
            UserUpdateControllerDataFixtures::USER_PASSWORD
        );

        $name = $this->faker->name;

        $this->makeRequest($client, [
            'id' => UserUpdateControllerDataFixtures::USER_ID,
            'email' => UserUpdateControllerDataFixtures::USER_EMAIL,
            'previousPassword' => UserUpdateControllerDataFixtures::USER_PASSWORD,
            'newPassword' => 'password',
            'name' => $name
        ]);

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $content = $response->getContent();

        $json = json_decode($content, true);

        $this->assertArrayHasKey('user', $json);
        $this->assertSame($name, $json['user']['name']);
    }

    /**
     * @param KernelBrowser $client
     * @param array $parameters
     */
    private function makeRequest(KernelBrowser $client, array $parameters)
    {
        $client->request('PATCH', '/user',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($parameters)
        );
    }
}