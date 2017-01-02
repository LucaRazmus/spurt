<?php

namespace Spurt\Test\Api;

use Spurt\Models\SessionsModel;
use Spurt\Services\SessionsService;
use Segura\AppCore\Test\RoutesTestCase;

class MessageTest extends RoutesTestCase
{
    public function testSendMessageBadSession()
    {
        $response = $this->request(
            "PUT",
            "/v1/messages",
            [
                "sessionKey" => "bogus",
                "characterUUID" => "ebd1f3f9-ab47-11e6-9808-0242ac11001d",
                "targetUUID" => "1700bcca-ab5c-11e6-85db-0242ac11001d",
                "message" => "Reticulating Splines"
            ]
        );

        $body = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Fail", $json['Status']);
        $this->assertArrayHasKey("Reason", $json);
        $this->assertEquals("Bad Session Key", $json['Reason']);

        $this->assertArrayNotHasKey("Message", $json);
    }

    public function testSendMessageNonExistantFromCharacterSession()
    {
        $response = $this->request(
            "PUT",
            "/v1/messages",
            [
                "sessionKey" => "21784eed-ab48-11e6-9808-0242ac11001d",
                "characterUUID" => "bogus",
                "targetUUID" => "1700bcca-ab5c-11e6-85db-0242ac11001d",
                "message" => "Reticulating Splines"
            ]
        );

        $body = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Fail", $json['Status']);
        $this->assertArrayHasKey("Reason", $json);
        $this->assertEquals("Cannot send from non-existent character", $json['Reason']);

        $this->assertArrayNotHasKey("Message", $json);
    }

    public function testSendMessageSendFromWrongUsersCharacterSession()
    {
        $response = $this->request(
            "PUT",
            "/v1/messages",
            [
                "sessionKey" => "21784eed-ab48-11e6-9808-0242ac11001d",
                "characterUUID" => "1700bcca-ab5c-11e6-85db-0242ac11001d",
                "targetUUID" => "ebd1f3f9-ab47-11e6-9808-0242ac11001d",
                "message" => "Reticulating Splines"
            ]
        );

        $body = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Fail", $json['Status']);
        $this->assertArrayHasKey("Reason", $json);
        $this->assertEquals("Cannot send from character that does not belong to you.", $json['Reason']);

        $this->assertArrayNotHasKey("Message", $json);
    }

    public function testSendMessageNonExistantToCharacterSession()
    {
        $response = $this->request(
            "PUT",
            "/v1/messages",
            [
                "sessionKey" => "21784eed-ab48-11e6-9808-0242ac11001d",
                "characterUUID" => "ebd1f3f9-ab47-11e6-9808-0242ac11001d",
                "targetUUID" => "bogus",
                "message" => "Reticulating Splines"
            ]
        );

        $body = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Fail", $json['Status']);
        $this->assertArrayHasKey("Reason", $json);
        $this->assertEquals("Cannot send to non-existent character", $json['Reason']);

        $this->assertArrayNotHasKey("Message", $json);
    }

    public function testSendMessageToOwnCharacterSession()
    {
        $response = $this->request(
            "PUT",
            "/v1/messages",
            [
                "sessionKey" => "21784eed-ab48-11e6-9808-0242ac11001d",
                "characterUUID" => "ebd1f3f9-ab47-11e6-9808-0242ac11001d",
                "targetUUID" => "ebd1ece5-ab47-11e6-9808-0242ac11001d",
                "message" => "Reticulating Splines"
            ]
        );

        $body = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Fail", $json['Status']);
        $this->assertArrayHasKey("Reason", $json);
        $this->assertEquals("Cannot send to character that belongs to you.", $json['Reason']);

        $this->assertArrayNotHasKey("Message", $json);
    }

    public function testSendMessageGood()
    {
        $response = $this->request(
            "PUT",
            "/v1/messages",
            [
                "sessionKey" => "21784eed-ab48-11e6-9808-0242ac11001d",
                "characterUUID" => "ebd1f3f9-ab47-11e6-9808-0242ac11001d",
                "targetUUID" => "1700bcca-ab5c-11e6-85db-0242ac11001d",
                "message" => "Reticulating Splines"
            ]
        );

        $body = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Okay", $json['Status']);

        $this->assertArrayHasKey("Message", $json);
    }

    public function testGetMessageQueueGood(){
        $response = $this->request(
            "POST",
            "/v1/messages",
            [
                "sessionKey" => "21784eed-ab48-11e6-9808-0242ac11001d",
            ]
        );

        $body = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull(json_decode($body));
        $json = json_decode($body, true);

        $this->assertArrayHasKey("Status", $json);
        $this->assertEquals("Okay", $json['Status']);

        $this->assertArrayHasKey("Messages", $json);

        $this->assertArrayHasKey("Uuid", reset($json['Messages']));
        $this->assertArrayNotHasKey("Id", reset($json['Messages']));
        $this->assertArrayHasKey("CharacterFrom", reset($json['Messages']));
        $this->assertArrayNotHasKey("CharacterFromId", reset($json['Messages']));
        $this->assertArrayHasKey("CharacterTo", reset($json['Messages']));
        $this->assertArrayNotHasKey("CharacterToId", reset($json['Messages']));

        $this->assertArrayHasKey("Uuid", reset($json['Messages'])['CharacterFrom']);
        $this->assertArrayHasKey("Name", reset($json['Messages'])['CharacterFrom']);
        $this->assertArrayHasKey("Description", reset($json['Messages'])['CharacterFrom']);
        $this->assertArrayHasKey("DateCreated", reset($json['Messages'])['CharacterFrom']);
        $this->assertArrayHasKey("DateLastSeen", reset($json['Messages'])['CharacterFrom']);
        $this->assertArrayHasKey("LinkToProfile", reset($json['Messages'])['CharacterFrom']);

        $this->assertArrayHasKey("Uuid", reset($json['Messages'])['CharacterTo']);
        $this->assertArrayHasKey("Name", reset($json['Messages'])['CharacterTo']);
        $this->assertArrayHasKey("Description", reset($json['Messages'])['CharacterTo']);
        $this->assertArrayHasKey("DateCreated", reset($json['Messages'])['CharacterTo']);
        $this->assertArrayHasKey("DateLastSeen", reset($json['Messages'])['CharacterTo']);
        $this->assertArrayHasKey("LinkToProfile", reset($json['Messages'])['CharacterTo']);
    }

}
