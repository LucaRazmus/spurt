<?php

namespace Spurt\Test\Api;

use Segura\AppCore\Test\RoutesTestCase;

class PingTest extends RoutesTestCase
{
    /**
     * @large
     */
    public function testPing()
    {
        $response = $this->request(
            "GET",
            "/v1/ping"
        );

        $body = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Okay", $json['Status']);
    }
}
