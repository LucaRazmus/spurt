<?php
namespace Spurt\Test\Models;

use \Spurt\TableGateways\OrgasmsTableGateway;
use \Spurt\Models\OrgasmsModel;
use \Spurt\Models;

class OrgasmsTest extends \Segura\AppCore\Test\BaseTestCase
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
        $data['user_id'] = self::getFaker()->randomDigitNotNull;
        $data['datetime'] = self::getFaker()->word;
        $this->testInstance = new OrgasmsModel($data);
        $this->assertEquals($data['id'], $this->testInstance->getId());
        $this->assertEquals($data['user_id'], $this->testInstance->getUser_id());
        $this->assertEquals($data['datetime'], $this->testInstance->getDatetime());
    }

    public function testGetRandom()
    {
        /** @var OrgasmsTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\OrgasmsTableGateway::class);

        // If there is no data in the table, create some.
        if($table->getCount() == 0){
            $dummyObject = $table->getNewMockModelInstance();
            $table->save($dummyObject);
        }

        $orgasms = $table->fetchRandom();
        $this->assertTrue($orgasms instanceof OrgasmsModel, "Make sure that \"" . get_class($orgasms) . "\" matches \"OrgasmsModel\"") ;

        return $orgasms;
    }

    public function testNewMockModelInstance()
    {
        /** @var OrgasmsTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\OrgasmsTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        $this->assertEquals('Spurt\Models\OrgasmsModel', get_class($newMockModel));

        return $newMockModel;
    }

    public function testNewModelFactory()
    {
        $instance = OrgasmsModel::factory();

        $this->assertEquals('Spurt\Models\OrgasmsModel', get_class($instance));
    }

    public function testSave()
    {
        /** @var OrgasmsTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\OrgasmsTableGateway::class);
        /** @var Models\OrgasmsModel $mockModel */
        /** @var Models\OrgasmsModel $savedModel */
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
    public function testGetById(OrgasmsModel $orgasms)
    {
        /** @var orgasmsTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\OrgasmsTableGateway::class);
        $results = $table->select(['id' => $orgasms->getId()]);
        $orgasmsRow = $results->current();
        $this->assertTrue($orgasmsRow instanceof OrgasmsModel);
    }

    /**
     * @depends testGetRandom
     */
    public function testSettersAndGetters(OrgasmsModel $orgasms)
    {
        $this->assertTrue(method_exists($orgasms, "getid"));
        $this->assertTrue(method_exists($orgasms, "setid"));
        $this->assertTrue(method_exists($orgasms, "getuser_id"));
        $this->assertTrue(method_exists($orgasms, "setuser_id"));
        $this->assertTrue(method_exists($orgasms, "getdatetime"));
        $this->assertTrue(method_exists($orgasms, "setdatetime"));

        $testOrgasms = new OrgasmsModel();
        $input = self::getFaker()->randomDigitNotNull;
        $testOrgasms->setid($input);
        $this->assertEquals($input, $testOrgasms->getid());
        $input = self::getFaker()->randomDigitNotNull;
        $testOrgasms->setuser_id($input);
        $this->assertEquals($input, $testOrgasms->getuser_id());
        $input = self::getFaker()->word;
        $testOrgasms->setdatetime($input);
        $this->assertEquals($input, $testOrgasms->getdatetime());
    }


    public function testAutoincrementedIdIsApplied()
    {
        /** @var OrgasmsTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\OrgasmsTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        // Set primary keys to null.
        $newMockModel->setid(null);

        // Save the object
        $newMockModel->save();

        // verify that the AI keys have been set.
        $this->assertNotNull($newMockModel->getId());
    }

}
