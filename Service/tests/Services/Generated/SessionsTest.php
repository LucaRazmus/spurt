<?php
namespace Spurt\Test\Services;

use \Spurt\Spurt as App;
use \Spurt\TableGateways\SessionsTableGateway;
use \Spurt\Services\SessionsService;
use \Spurt\Models\SessionsModel;

class SessionsTest extends \Segura\AppCore\Test\BaseTestCase
{
    public static function setUpBeforeClass()
    {
        $sessionsTableGateway = App::Container()->get(SessionsTableGateway::class);
        parent::setUpBeforeClass();

        for($i = 0; $i <= 5; $i++){
            $sessionsTableGateway
                ->getNewMockModelInstance()
                ->save();
        }
    }

    /**
     * @large
     */
    public function testGetAll()
    {
        $sessionsService = App::Container()->get(SessionsService::class);
        $all = $sessionsService->getAll();
        $this->assertEquals('Spurt\Models\SessionsModel', get_class(reset($all)));
    }

    public function testGetRandom()
    {
        $sessionsService = App::Container()->get(SessionsService::class);

        $random = $sessionsService->getRandom();
        $this->assertEquals(
            'Spurt\Models\SessionsModel',
            get_class($random)
        );

        return $random;
    }

    public function testGetMockObject()
    {
        $sessionsService = App::Container()->get(SessionsService::class);
        $this->assertEquals(
            'Spurt\Models\SessionsModel',
            get_class($sessionsService->getMockObject())
        );
    }

    /**
     * @depends testGetRandom
     */
    public function testGetByField(SessionsModel $random)
    {
        $sessionsService = App::Container()->get(SessionsService::class);
        $found = $sessionsService->getByField('id', $random->getid());
        $this->assertEquals(
            'Spurt\Models\SessionsModel',
            get_class($found)
        );
        $found = $sessionsService->getByField('userId', $random->getuserId());
        $this->assertEquals(
            'Spurt\Models\SessionsModel',
            get_class($found)
        );
        $found = $sessionsService->getByField('start', $random->getstart());
        $this->assertEquals(
            'Spurt\Models\SessionsModel',
            get_class($found)
        );
        $found = $sessionsService->getByField('end', $random->getend());
        $this->assertEquals(
            'Spurt\Models\SessionsModel',
            get_class($found)
        );
    }

    public function testGetTermPlural()
    {
        $sessionsService = App::Container()->get(SessionsService::class);
        $this->assertNotEmpty($sessionsService->getTermPlural());
    }

    public function testGetTermSingular()
    {
        $sessionsService = App::Container()->get(SessionsService::class);
        $this->assertNotEmpty($sessionsService->getTermSingular());
    }
}
