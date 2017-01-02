<?php
namespace Spurt\Test\Services;

use \Spurt\Spurt as App;
use \Spurt\TableGateways\CausesTableGateway;
use \Spurt\Services\CausesService;
use \Spurt\Models\CausesModel;

class CausesTest extends \Segura\AppCore\Test\BaseTestCase
{
    public static function setUpBeforeClass()
    {
        $causesTableGateway = App::Container()->get(CausesTableGateway::class);
        parent::setUpBeforeClass();

        for($i = 0; $i <= 5; $i++){
            $causesTableGateway
                ->getNewMockModelInstance()
                ->save();
        }
    }

    /**
     * @large
     */
    public function testGetAll()
    {
        $causesService = App::Container()->get(CausesService::class);
        $all = $causesService->getAll();
        $this->assertEquals('Spurt\Models\CausesModel', get_class(reset($all)));
    }

    public function testGetRandom()
    {
        $causesService = App::Container()->get(CausesService::class);

        $random = $causesService->getRandom();
        $this->assertEquals(
            'Spurt\Models\CausesModel',
            get_class($random)
        );

        return $random;
    }

    public function testGetMockObject()
    {
        $causesService = App::Container()->get(CausesService::class);
        $this->assertEquals(
            'Spurt\Models\CausesModel',
            get_class($causesService->getMockObject())
        );
    }

    /**
     * @depends testGetRandom
     */
    public function testGetByField(CausesModel $random)
    {
        $causesService = App::Container()->get(CausesService::class);
        $found = $causesService->getByField('id', $random->getid());
        $this->assertEquals(
            'Spurt\Models\CausesModel',
            get_class($found)
        );
        $found = $causesService->getByField('name', $random->getname());
        $this->assertEquals(
            'Spurt\Models\CausesModel',
            get_class($found)
        );
    }

    public function testGetTermPlural()
    {
        $causesService = App::Container()->get(CausesService::class);
        $this->assertNotEmpty($causesService->getTermPlural());
    }

    public function testGetTermSingular()
    {
        $causesService = App::Container()->get(CausesService::class);
        $this->assertNotEmpty($causesService->getTermSingular());
    }
}
