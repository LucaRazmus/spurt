<?php
namespace Spurt\Test\Models;

use \Spurt\TableGateways\UsersTableGateway;
use \Spurt\Models\UsersModel;
use \Spurt\Models;

class UsersTest extends \Segura\AppCore\Test\BaseTestCase
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
        $data['username'] = self::getFaker()->word;
        $data['email'] = self::getFaker()->word;
        $data['password'] = self::getFaker()->word;
        $data['dateCreated'] = self::getFaker()->word;
        $data['dateLastSeen'] = self::getFaker()->word;
        $data['state'] = self::getFaker()->word;
        $this->testInstance = new UsersModel($data);
        $this->assertEquals($data['id'], $this->testInstance->getId());
        $this->assertEquals($data['uuid'], $this->testInstance->getUuid());
        $this->assertEquals($data['username'], $this->testInstance->getUsername());
        $this->assertEquals($data['email'], $this->testInstance->getEmail());
        $this->assertEquals($data['password'], $this->testInstance->getPassword());
        $this->assertEquals($data['dateCreated'], $this->testInstance->getDateCreated());
        $this->assertEquals($data['dateLastSeen'], $this->testInstance->getDateLastSeen());
        $this->assertEquals($data['state'], $this->testInstance->getState());
    }

    public function testGetRandom()
    {
        /** @var UsersTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\UsersTableGateway::class);

        // If there is no data in the table, create some.
        if($table->getCount() == 0){
            $dummyObject = $table->getNewMockModelInstance();
            $table->save($dummyObject);
        }

        $users = $table->fetchRandom();
        $this->assertTrue($users instanceof UsersModel, "Make sure that \"" . get_class($users) . "\" matches \"UsersModel\"") ;

        return $users;
    }

    public function testNewMockModelInstance()
    {
        /** @var UsersTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\UsersTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        $this->assertEquals('Spurt\Models\UsersModel', get_class($newMockModel));

        return $newMockModel;
    }

    public function testNewModelFactory()
    {
        $instance = UsersModel::factory();

        $this->assertEquals('Spurt\Models\UsersModel', get_class($instance));
    }

    public function testSave()
    {
        /** @var UsersTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\UsersTableGateway::class);
        /** @var Models\UsersModel $mockModel */
        /** @var Models\UsersModel $savedModel */
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
    public function testGetById(UsersModel $users)
    {
        /** @var usersTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\UsersTableGateway::class);
        $results = $table->select(['id' => $users->getId()]);
        $usersRow = $results->current();
        $this->assertTrue($usersRow instanceof UsersModel);
    }

    /**
     * @depends testGetRandom
     */
    public function testSettersAndGetters(UsersModel $users)
    {
        $this->assertTrue(method_exists($users, "getid"));
        $this->assertTrue(method_exists($users, "setid"));
        $this->assertTrue(method_exists($users, "getuuid"));
        $this->assertTrue(method_exists($users, "setuuid"));
        $this->assertTrue(method_exists($users, "getusername"));
        $this->assertTrue(method_exists($users, "setusername"));
        $this->assertTrue(method_exists($users, "getemail"));
        $this->assertTrue(method_exists($users, "setemail"));
        $this->assertTrue(method_exists($users, "getpassword"));
        $this->assertTrue(method_exists($users, "setpassword"));
        $this->assertTrue(method_exists($users, "getdateCreated"));
        $this->assertTrue(method_exists($users, "setdateCreated"));
        $this->assertTrue(method_exists($users, "getdateLastSeen"));
        $this->assertTrue(method_exists($users, "setdateLastSeen"));
        $this->assertTrue(method_exists($users, "getstate"));
        $this->assertTrue(method_exists($users, "setstate"));

        $testUsers = new UsersModel();
        $input = self::getFaker()->randomDigitNotNull;
        $testUsers->setid($input);
        $this->assertEquals($input, $testUsers->getid());
        $input = self::getFaker()->word;
        $testUsers->setuuid($input);
        $this->assertEquals($input, $testUsers->getuuid());
        $input = self::getFaker()->word;
        $testUsers->setusername($input);
        $this->assertEquals($input, $testUsers->getusername());
        $input = self::getFaker()->word;
        $testUsers->setemail($input);
        $this->assertEquals($input, $testUsers->getemail());
        $input = self::getFaker()->word;
        $testUsers->setpassword($input);
        $this->assertEquals($input, $testUsers->getpassword());
        $input = self::getFaker()->word;
        $testUsers->setdateCreated($input);
        $this->assertEquals($input, $testUsers->getdateCreated());
        $input = self::getFaker()->word;
        $testUsers->setdateLastSeen($input);
        $this->assertEquals($input, $testUsers->getdateLastSeen());
        $input = self::getFaker()->word;
        $testUsers->setstate($input);
        $this->assertEquals($input, $testUsers->getstate());
    }


    public function testAutoincrementedIdIsApplied()
    {
        /** @var UsersTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\UsersTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        // Set primary keys to null.
        $newMockModel->setid(null);

        // Save the object
        $newMockModel->save();

        // verify that the AI keys have been set.
        $this->assertNotNull($newMockModel->getId());
    }

}
