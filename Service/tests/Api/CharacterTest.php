<?php

namespace Spurt\Test\Api;

use Spurt\Models\SessionsModel;
use Spurt\Services\SessionsService;
use Segura\AppCore\Test\RoutesTestCase;

class CharacterTest extends RoutesTestCase
{
    public function testGetCharacterGood()
    {
        $response = $this->request(
            "GET",
            "/v1/characters/ebd1f3f9-ab47-11e6-9808-0242ac11001d"
        );

        $body = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Okay", $json['Status']);

        $this->assertArrayHasKey("Character", $json);
    }

    public function testGetCharacterBad()
    {
        $response = $this->request(
            "GET",
            "/v1/characters/nope"
        );

        $body = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Does not exist", $json['Status']);

        $this->assertArrayNotHasKey("Character", $json);
    }
}
