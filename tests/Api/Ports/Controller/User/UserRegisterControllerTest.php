<?php


namespace App\Tests\Api\Ports\Controller\User;


use Faker\Factory;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserRegisterControllerTest
 * @package App\Tests\Api\Ports\Controller\User
 */
class UserRegisterControllerTest extends WebTestCase
{
    /**
     * @var Generator
     */
    private $faker;

    protected function setUp()
    {
        $this->faker = Factory::create();
    }

    /**
     * @test
     * @group functional
     */
    public function shouldRegisterUser()
    {
        $client = static::createClient();

        $email = $this->faker->email;
        $name = $this->faker->name;

        $this->makeRequest($client, [
            'email' => $email,
            'password' => $this->faker->password,
            'name' => $name
        ]);

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $content = $response->getContent();

        $json = json_decode($content, true);

        $this->assertArrayHasKey('user', $json);
        $this->assertNotNull($json['user']['id']);
        $this->assertSame($email, $json['user']['email']);
        $this->assertSame($name, $json['user']['name']);
    }

    /**
     * @test
     * @group functional
     * @dataProvider shouldThrowWhenMissingRequiredParameterDataProvider
     */
    public function shouldReturnBadRequestWhenMissingRequiredParameter(array $params)
    {
        $client = static::createClient();

        $this->makeRequest($client, $params);

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function shouldThrowWhenMissingRequiredParameterDataProvider()
    {
        return [
            [['email' => 'email', 'password' => 'password']],
            [['email' => 'email', 'name' => 'name']],
            [['password' => 'password', 'name' => 'name']],
        ];
    }

    /**
     * @test
     * @group functional
     */
    public function shouldReturnBadRequestWhenInvalidEmail()
    {
        $client = static::createClient();

        $this->makeRequest($client, [
            'email' => 'non-valid-email',
            'password' => $this->faker->password,
            'name' => $this->faker->name
        ]);

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    /**
     * @param KernelBrowser $client
     * @param array $data
     */
    private function makeRequest(KernelBrowser $client, array $data)
    {
        $client->request('POST', '/api/user', $data, [], [
            'HTTP_CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json'
        ]);
    }
}