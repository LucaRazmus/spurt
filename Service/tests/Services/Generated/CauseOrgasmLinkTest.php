<?php
namespace Spurt\Test\Services;

use \Spurt\Spurt as App;
use \Spurt\TableGateways\CauseOrgasmLinkTableGateway;
use \Spurt\Services\CauseOrgasmLinkService;
use \Spurt\Models\CauseOrgasmLinkModel;

class CauseOrgasmLinkTest extends \Segura\AppCore\Test\BaseTestCase
{
    public static function setUpBeforeClass()
    {
        $causeOrgasmLinkTableGateway = App::Container()->get(CauseOrgasmLinkTableGateway::class);
        parent::setUpBeforeClass();

        for($i = 0; $i <= 5; $i++){
            $causeOrgasmLinkTableGateway
                ->getNewMockModelInstance()
                ->save();
        }
    }

    /**
     * @large
     */
    public function testGetAll()
    {
        $causeOrgasmLinkService = App::Container()->get(CauseOrgasmLinkService::class);
        $all = $causeOrgasmLinkService->getAll();
        $this->assertEquals('Spurt\Models\CauseOrgasmLinkModel', get_class(reset($all)));
    }

    public function testGetRandom()
    {
        $causeOrgasmLinkService = App::Container()->get(CauseOrgasmLinkService::class);

        $random = $causeOrgasmLinkService->getRandom();
        $this->assertEquals(
            'Spurt\Models\CauseOrgasmLinkModel',
            get_class($random)
        );

        return $random;
    }

    public function testGetMockObject()
    {
        $causeOrgasmLinkService = App::Container()->get(CauseOrgasmLinkService::class);
        $this->assertEquals(
            'Spurt\Models\CauseOrgasmLinkModel',
            get_class($causeOrgasmLinkService->getMockObject())
        );
    }

    /**
     * @depends testGetRandom
     */
    public function testGetByField(CauseOrgasmLinkModel $random)
    {
        $causeOrgasmLinkService = App::Container()->get(CauseOrgasmLinkService::class);
        $found = $causeOrgasmLinkService->getByField('id', $random->getid());
        $this->assertEquals(
            'Spurt\Models\CauseOrgasmLinkModel',
            get_class($found)
        );
        $found = $causeOrgasmLinkService->getByField('cause_id', $random->getcause_id());
        $this->assertEquals(
            'Spurt\Models\CauseOrgasmLinkModel',
            get_class($found)
        );
        $found = $causeOrgasmLinkService->getByField('orgasm_id', $random->getorgasm_id());
        $this->assertEquals(
            'Spurt\Models\CauseOrgasmLinkModel',
            get_class($found)
        );
    }

    public function testGetTermPlural()
    {
        $causeOrgasmLinkService = App::Container()->get(CauseOrgasmLinkService::class);
        $this->assertNotEmpty($causeOrgasmLinkService->getTermPlural());
    }

    public function testGetTermSingular()
    {
        $causeOrgasmLinkService = App::Container()->get(CauseOrgasmLinkService::class);
        $this->assertNotEmpty($causeOrgasmLinkService->getTermSingular());
    }
}
