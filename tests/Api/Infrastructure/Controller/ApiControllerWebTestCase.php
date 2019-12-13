<?php


namespace App\Tests\Api\Infrastructure\Controller;


use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class ApiControllerWebTestCase extends WebTestCase
{
    /**
     * @param string $username
     * @param string $password
     * @return KernelBrowser
     */
    protected function createAuthenticateClient(string $username, string  $password)
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/auth/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'username' => $username,
                'password' => $password
            ])
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client->setServerParameter(
            'HTTP_Authorization',
            sprintf('Bearer %s', $data['token']
        ));

        return $client;
    }
}