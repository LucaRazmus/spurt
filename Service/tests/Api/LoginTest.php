<?php

namespace Spurt\Test\Api;

use Spurt\Models\SessionsModel;
use Spurt\Services\SessionsService;
use Segura\AppCore\Test\RoutesTestCase;

class LoginTest extends RoutesTestCase
{
    public function testLoginGood()
    {
        $response = $this->request(
            "POST",
            "/v1/login",
            json_encode([
                'username' => 'geusebio',
                'password' => 'example_password'
            ])
        );

        $body = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Okay", $json['Status']);

        $this->assertArrayHasKey("Session", $json);

        /** @var SessionsService $sessionsService */
        $sessionsService = $this->getDIContainer()->get(SessionsService::class);

        /** @var SessionsModel $session */
        $session = $sessionsService->getByField('key', $json['Session']);

        $this->assertTrue($session instanceof SessionsModel);

        $this->assertEquals(1, $session->getUserId());
    }

    public function testLoginBad()
    {
        $response = $this->request(
            "POST",
            "/v1/login",
            json_encode([
                'username' => 'geusebio',
                'password' => 'wrong_password'
            ])
        );

        $body = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Denied", $json['Status']);

        $this->assertArrayNotHasKey("Session", $json);
    }
}
