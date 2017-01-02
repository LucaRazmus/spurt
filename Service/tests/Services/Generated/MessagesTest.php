<?php
namespace Spurt\Test\Services;

use \Spurt\Spurt as App;
use \Spurt\TableGateways\MessagesTableGateway;
use \Spurt\Services\MessagesService;
use \Spurt\Models\MessagesModel;

class MessagesTest extends \Segura\AppCore\Test\BaseTestCase
{
    public static function setUpBeforeClass()
    {
        $messagesTableGateway = App::Container()->get(MessagesTableGateway::class);
        parent::setUpBeforeClass();

        for($i = 0; $i <= 5; $i++){
            $messagesTableGateway
                ->getNewMockModelInstance()
                ->save();
        }
    }

    /**
     * @large
     */
    public function testGetAll()
    {
        $messagesService = App::Container()->get(MessagesService::class);
        $all = $messagesService->getAll();
        $this->assertEquals('Spurt\Models\MessagesModel', get_class(reset($all)));
    }

    public function testGetRandom()
    {
        $messagesService = App::Container()->get(MessagesService::class);

        $random = $messagesService->getRandom();
        $this->assertEquals(
            'Spurt\Models\MessagesModel',
            get_class($random)
        );

        return $random;
    }

    public function testGetMockObject()
    {
        $messagesService = App::Container()->get(MessagesService::class);
        $this->assertEquals(
            'Spurt\Models\MessagesModel',
            get_class($messagesService->getMockObject())
        );
    }

    /**
     * @depends testGetRandom
     */
    public function testGetByField(MessagesModel $random)
    {
        $messagesService = App::Container()->get(MessagesService::class);
        $found = $messagesService->getByField('id', $random->getid());
        $this->assertEquals(
            'Spurt\Models\MessagesModel',
            get_class($found)
        );
        $found = $messagesService->getByField('uuid', $random->getuuid());
        $this->assertEquals(
            'Spurt\Models\MessagesModel',
            get_class($found)
        );
        $found = $messagesService->getByField('characterFromId', $random->getcharacterFromId());
        $this->assertEquals(
            'Spurt\Models\MessagesModel',
            get_class($found)
        );
        $found = $messagesService->getByField('characterToId', $random->getcharacterToId());
        $this->assertEquals(
            'Spurt\Models\MessagesModel',
            get_class($found)
        );
        $found = $messagesService->getByField('message', $random->getmessage());
        $this->assertEquals(
            'Spurt\Models\MessagesModel',
            get_class($found)
        );
        $found = $messagesService->getByField('dateCreated', $random->getdateCreated());
        $this->assertEquals(
            'Spurt\Models\MessagesModel',
            get_class($found)
        );
        $found = $messagesService->getByField('dateRead', $random->getdateRead());
        $this->assertEquals(
            'Spurt\Models\MessagesModel',
            get_class($found)
        );
    }

    public function testGetTermPlural()
    {
        $messagesService = App::Container()->get(MessagesService::class);
        $this->assertNotEmpty($messagesService->getTermPlural());
    }

    public function testGetTermSingular()
    {
        $messagesService = App::Container()->get(MessagesService::class);
        $this->assertNotEmpty($messagesService->getTermSingular());
    }
}
