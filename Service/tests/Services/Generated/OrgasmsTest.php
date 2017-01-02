<?php
namespace Spurt\Test\Services;

use \Spurt\Spurt as App;
use \Spurt\TableGateways\OrgasmsTableGateway;
use \Spurt\Services\OrgasmsService;
use \Spurt\Models\OrgasmsModel;

class OrgasmsTest extends \Segura\AppCore\Test\BaseTestCase
{
    public static function setUpBeforeClass()
    {
        $orgasmsTableGateway = App::Container()->get(OrgasmsTableGateway::class);
        parent::setUpBeforeClass();

        for($i = 0; $i <= 5; $i++){
            $orgasmsTableGateway
                ->getNewMockModelInstance()
                ->save();
        }
    }

    /**
     * @large
     */
    public function testGetAll()
    {
        $orgasmsService = App::Container()->get(OrgasmsService::class);
        $all = $orgasmsService->getAll();
        $this->assertEquals('Spurt\Models\OrgasmsModel', get_class(reset($all)));
    }

    public function testGetRandom()
    {
        $orgasmsService = App::Container()->get(OrgasmsService::class);

        $random = $orgasmsService->getRandom();
        $this->assertEquals(
            'Spurt\Models\OrgasmsModel',
            get_class($random)
        );

        return $random;
    }

    public function testGetMockObject()
    {
        $orgasmsService = App::Container()->get(OrgasmsService::class);
        $this->assertEquals(
            'Spurt\Models\OrgasmsModel',
            get_class($orgasmsService->getMockObject())
        );
    }

    /**
     * @depends testGetRandom
     */
    public function testGetByField(OrgasmsModel $random)
    {
        $orgasmsService = App::Container()->get(OrgasmsService::class);
        $found = $orgasmsService->getByField('id', $random->getid());
        $this->assertEquals(
            'Spurt\Models\OrgasmsModel',
            get_class($found)
        );
        $found = $orgasmsService->getByField('user_id', $random->getuser_id());
        $this->assertEquals(
            'Spurt\Models\OrgasmsModel',
            get_class($found)
        );
        $found = $orgasmsService->getByField('datetime', $random->getdatetime());
        $this->assertEquals(
            'Spurt\Models\OrgasmsModel',
            get_class($found)
        );
    }

    public function testGetTermPlural()
    {
        $orgasmsService = App::Container()->get(OrgasmsService::class);
        $this->assertNotEmpty($orgasmsService->getTermPlural());
    }

    public function testGetTermSingular()
    {
        $orgasmsService = App::Container()->get(OrgasmsService::class);
        $this->assertNotEmpty($orgasmsService->getTermSingular());
    }
}
