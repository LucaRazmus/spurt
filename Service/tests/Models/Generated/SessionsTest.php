<?php
namespace Spurt\Test\Models;

use \Spurt\TableGateways\SessionsTableGateway;
use \Spurt\Models\SessionsModel;
use \Spurt\Models;

class SessionsTest extends \Segura\AppCore\Test\BaseTestCase
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
        $data['uuid'] = self::getFaker()->word;
        $data['userId'] = self::getFaker()->randomDigitNotNull;
        $data['key'] = self::getFaker()->word;
        $data['created'] = self::getFaker()->word;
        $data['expires'] = self::getFaker()->word;
        $this->testInstance = new SessionsModel($data);
        $this->assertEquals($data['id'], $this->testInstance->getId());
        $this->assertEquals($data['uuid'], $this->testInstance->getUuid());
        $this->assertEquals($data['userId'], $this->testInstance->getUserId());
        $this->assertEquals($data['key'], $this->testInstance->getKey());
        $this->assertEquals($data['created'], $this->testInstance->getCreated());
        $this->assertEquals($data['expires'], $this->testInstance->getExpires());
    }

    public function testGetRandom()
    {
        /** @var SessionsTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\SessionsTableGateway::class);

        // If there is no data in the table, create some.
        if($table->getCount() == 0){
            $dummyObject = $table->getNewMockModelInstance();
            $table->save($dummyObject);
        }

        $sessions = $table->fetchRandom();
        $this->assertTrue($sessions instanceof SessionsModel, "Make sure that \"" . get_class($sessions) . "\" matches \"SessionsModel\"") ;

        return $sessions;
    }

    public function testNewMockModelInstance()
    {
        /** @var SessionsTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\SessionsTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        $this->assertEquals('Spurt\Models\SessionsModel', get_class($newMockModel));

        return $newMockModel;
    }

    public function testNewModelFactory()
    {
        $instance = SessionsModel::factory();

        $this->assertEquals('Spurt\Models\SessionsModel', get_class($instance));
    }

    public function testSave()
    {
        /** @var SessionsTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\SessionsTableGateway::class);
        /** @var Models\SessionsModel $mockModel */
        /** @var Models\SessionsModel $savedModel */
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
    public function testGetById(SessionsModel $sessions)
    {
        /** @var sessionsTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\SessionsTableGateway::class);
        $results = $table->select(['id' => $sessions->getId()]);
        $sessionsRow = $results->current();
        $this->assertTrue($sessionsRow instanceof SessionsModel);
    }

    /**
     * @depends testGetRandom
     */
    public function testSettersAndGetters(SessionsModel $sessions)
    {
        $this->assertTrue(method_exists($sessions, "getid"));
        $this->assertTrue(method_exists($sessions, "setid"));
        $this->assertTrue(method_exists($sessions, "getuuid"));
        $this->assertTrue(method_exists($sessions, "setuuid"));
        $this->assertTrue(method_exists($sessions, "getuserId"));
        $this->assertTrue(method_exists($sessions, "setuserId"));
        $this->assertTrue(method_exists($sessions, "getkey"));
        $this->assertTrue(method_exists($sessions, "setkey"));
        $this->assertTrue(method_exists($sessions, "getcreated"));
        $this->assertTrue(method_exists($sessions, "setcreated"));
        $this->assertTrue(method_exists($sessions, "getexpires"));
        $this->assertTrue(method_exists($sessions, "setexpires"));

        $testSessions = new SessionsModel();
        $input = self::getFaker()->randomDigitNotNull;
        $testSessions->setid($input);
        $this->assertEquals($input, $testSessions->getid());
        $input = self::getFaker()->word;
        $testSessions->setuuid($input);
        $this->assertEquals($input, $testSessions->getuuid());
        $input = self::getFaker()->randomDigitNotNull;
        $testSessions->setuserId($input);
        $this->assertEquals($input, $testSessions->getuserId());
        $input = self::getFaker()->word;
        $testSessions->setkey($input);
        $this->assertEquals($input, $testSessions->getkey());
        $input = self::getFaker()->word;
        $testSessions->setcreated($input);
        $this->assertEquals($input, $testSessions->getcreated());
        $input = self::getFaker()->word;
        $testSessions->setexpires($input);
        $this->assertEquals($input, $testSessions->getexpires());
    }


    public function testAutoincrementedIdIsApplied()
    {
        /** @var SessionsTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\SessionsTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        // Set primary keys to null.
        $newMockModel->setid(null);

        // Save the object
        $newMockModel->save();

        // verify that the AI keys have been set.
        $this->assertNotNull($newMockModel->getId());
    }

}
