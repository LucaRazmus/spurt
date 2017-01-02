<?php
namespace Spurt\Test\Models;

use \Spurt\TableGateways\CauseOrgasmLinkTableGateway;
use \Spurt\Models\CauseOrgasmLinkModel;
use \Spurt\Models;

class CauseOrgasmLinkTest extends \Segura\AppCore\Test\BaseTestCase
{
    protected $testInstance;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
    }

    public function testExchangeArray()
    {
        $data = [];
        $data['id'] = self::getFaker()->randomDigitNotNull;
        $data['cause_id'] = self::getFaker()->randomDigitNotNull;
        $data['orgasm_id'] = self::getFaker()->randomDigitNotNull;
        $this->testInstance = new CauseOrgasmLinkModel($data);
        $this->assertEquals($data['id'], $this->testInstance->getId());
        $this->assertEquals($data['cause_id'], $this->testInstance->getCause_id());
        $this->assertEquals($data['orgasm_id'], $this->testInstance->getOrgasm_id());
    }

    public function testGetRandom()
    {
        /** @var CauseOrgasmLinkTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CauseOrgasmLinkTableGateway::class);

        // If there is no data in the table, create some.
        if($table->getCount() == 0){
            $dummyObject = $table->getNewMockModelInstance();
            $table->save($dummyObject);
        }

        $causeorgasmlink = $table->fetchRandom();
        $this->assertTrue($causeorgasmlink instanceof CauseOrgasmLinkModel, "Make sure that \"" . get_class($causeorgasmlink) . "\" matches \"CauseOrgasmLinkModel\"") ;

        return $causeorgasmlink;
    }

    public function testNewMockModelInstance()
    {
        /** @var CauseOrgasmLinkTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CauseOrgasmLinkTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        $this->assertEquals('Spurt\Models\CauseOrgasmLinkModel', get_class($newMockModel));

        return $newMockModel;
    }

    public function testNewModelFactory()
    {
        $instance = CauseOrgasmLinkModel::factory();

        $this->assertEquals('Spurt\Models\CauseOrgasmLinkModel', get_class($instance));
    }

    public function testSave()
    {
        /** @var CauseOrgasmLinkTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CauseOrgasmLinkTableGateway::class);
        /** @var Models\CauseOrgasmLinkModel $mockModel */
        /** @var Models\CauseOrgasmLinkModel $savedModel */
        $mockModel = $table->getNewMockModelInstance();
        $savedModel = $mockModel->save();

        $mockModelArray = $mockModel->__toArray();
        $savedModelArray = $savedModel->__toArray();

        // Remove auto increments from test.
        foreach($mockModel->getAutoIncrementKeys() as $autoIncrementKey => $discard){
            foreach($mockModelArray as $key => $value){
                if(strtolower($key) == strtolower($autoIncrementKey)){
                    unset($mockModelArray[$key]);
                    unset($savedModelArray[$key]);
                }
            }
        }

        $this->assertEquals($mockModelArray, $savedModelArray);
    }

    /**
     * @depends testGetRandom
     */
    public function testGetById(CauseOrgasmLinkModel $causeOrgasmLink)
    {
        /** @var causeOrgasmLinkTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CauseOrgasmLinkTableGateway::class);
        $results = $table->select(['id' => $causeOrgasmLink->getId()]);
        $causeOrgasmLinkRow = $results->current();
        $this->assertTrue($causeOrgasmLinkRow instanceof CauseOrgasmLinkModel);
    }

    /**
     * @depends testGetRandom
     */
    public function testSettersAndGetters(CauseOrgasmLinkModel $causeOrgasmLink)
    {
        $this->assertTrue(method_exists($causeOrgasmLink, "getid"));
        $this->assertTrue(method_exists($causeOrgasmLink, "setid"));
        $this->assertTrue(method_exists($causeOrgasmLink, "getcause_id"));
        $this->assertTrue(method_exists($causeOrgasmLink, "setcause_id"));
        $this->assertTrue(method_exists($causeOrgasmLink, "getorgasm_id"));
        $this->assertTrue(method_exists($causeOrgasmLink, "setorgasm_id"));

        $testCauseOrgasmLink = new CauseOrgasmLinkModel();
        $input = self::getFaker()->randomDigitNotNull;
        $testCauseOrgasmLink->setid($input);
        $this->assertEquals($input, $testCauseOrgasmLink->getid());
        $input = self::getFaker()->randomDigitNotNull;
        $testCauseOrgasmLink->setcause_id($input);
        $this->assertEquals($input, $testCauseOrgasmLink->getcause_id());
        $input = self::getFaker()->randomDigitNotNull;
        $testCauseOrgasmLink->setorgasm_id($input);
        $this->assertEquals($input, $testCauseOrgasmLink->getorgasm_id());
    }


    public function testAutoincrementedIdIsApplied()
    {
        /** @var CauseOrgasmLinkTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CauseOrgasmLinkTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        // Set primary keys to null.
        $newMockModel->setid(null);

        // Save the object
        $newMockModel->save();

        // verify that the AI keys have been set.
        $this->assertNotNull($newMockModel->getId());
    }

}
