<?php
namespace Spurt\Test\Services;

use \Spurt\Spurt as App;
use \Spurt\TableGateways\CharactersTableGateway;
use \Spurt\Services\CharactersService;
use \Spurt\Models\CharactersModel;

class CharactersTest extends \Segura\AppCore\Test\BaseTestCase
{
    public static function setUpBeforeClass()
    {
        $charactersTableGateway = App::Container()->get(CharactersTableGateway::class);
        parent::setUpBeforeClass();

        for($i = 0; $i <= 5; $i++){
            $charactersTableGateway
                ->getNewMockModelInstance()
                ->save();
        }
    }

    /**
     * @large
     */
    public function testGetAll()
    {
        $charactersService = App::Container()->get(CharactersService::class);
        $all = $charactersService->getAll();
        $this->assertEquals('Spurt\Models\CharactersModel', get_class(reset($all)));
    }

    public function testGetRandom()
    {
        $charactersService = App::Container()->get(CharactersService::class);

        $random = $charactersService->getRandom();
        $this->assertEquals(
            'Spurt\Models\CharactersModel',
            get_class($random)
        );

        return $random;
    }

    public function testGetMockObject()
    {
        $charactersService = App::Container()->get(CharactersService::class);
        $this->assertEquals(
            'Spurt\Models\CharactersModel',
            get_class($charactersService->getMockObject())
        );
    }

    /**
     * @depends testGetRandom
     */
    public function testGetByField(CharactersModel $random)
    {
        $charactersService = App::Container()->get(CharactersService::class);
        $found = $charactersService->getByField('id', $random->getid());
        $this->assertEquals(
            'Spurt\Models\CharactersModel',
            get_class($found)
        );
        $found = $charactersService->getByField('uuid', $random->getuuid());
        $this->assertEquals(
            'Spurt\Models\CharactersModel',
            get_class($found)
        );
        $found = $charactersService->getByField('userId', $random->getuserId());
        $this->assertEquals(
            'Spurt\Models\CharactersModel',
            get_class($found)
        );
        $found = $charactersService->getByField('name', $random->getname());
        $this->assertEquals(
            'Spurt\Models\CharactersModel',
            get_class($found)
        );
        $found = $charactersService->getByField('description', $random->getdescription());
        $this->assertEquals(
            'Spurt\Models\CharactersModel',
            get_class($found)
        );
        $found = $charactersService->getByField('dateCreated', $random->getdateCreated());
        $this->assertEquals(
            'Spurt\Models\CharactersModel',
            get_class($found)
        );
        $found = $charactersService->getByField('dateLastSeen', $random->getdateLastSeen());
        $this->assertEquals(
            'Spurt\Models\CharactersModel',
            get_class($found)
        );
    }

    public function testGetTermPlural()
    {
        $charactersService = App::Container()->get(CharactersService::class);
        $this->assertNotEmpty($charactersService->getTermPlural());
    }

    public function testGetTermSingular()
    {
        $charactersService = App::Container()->get(CharactersService::class);
        $this->assertNotEmpty($charactersService->getTermSingular());
    }
}
