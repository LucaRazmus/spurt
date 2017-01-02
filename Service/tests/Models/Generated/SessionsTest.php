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
        $data['user_id'] = self::getFaker()->randomDigitNotNull;
        $data['start'] = self::getFaker()->word;
        $data['end'] = self::getFaker()->word;
        $this->testInstance = new SessionsModel($data);
        $this->assertEquals($data['id'], $this->testInstance->getId());
        $this->assertEquals($data['user_id'], $this->testInstance->getUser_id());
        $this->assertEquals($data['start'], $this->testInstance->getStart());
        $this->assertEquals($data['end'], $this->testInstance->getEnd());
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
        $this->assertTrue(method_exists($sessions, "getuser_id"));
        $this->assertTrue(method_exists($sessions, "setuser_id"));
        $this->assertTrue(method_exists($sessions, "getstart"));
        $this->assertTrue(method_exists($sessions, "setstart"));
        $this->assertTrue(method_exists($sessions, "getend"));
        $this->assertTrue(method_exists($sessions, "setend"));

        $testSessions = new SessionsModel();
        $input = self::getFaker()->randomDigitNotNull;
        $testSessions->setid($input);
        $this->assertEquals($input, $testSessions->getid());
        $input = self::getFaker()->randomDigitNotNull;
        $testSessions->setuser_id($input);
        $this->assertEquals($input, $testSessions->getuser_id());
        $input = self::getFaker()->word;
        $testSessions->setstart($input);
        $this->assertEquals($input, $testSessions->getstart());
        $input = self::getFaker()->word;
        $testSessions->setend($input);
        $this->assertEquals($input, $testSessions->getend());
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
