<?php
namespace Spurt\Test\Models;

use \Spurt\TableGateways\CharactersTableGateway;
use \Spurt\Models\CharactersModel;
use \Spurt\Models;

class CharactersTest extends \Segura\AppCore\Test\BaseTestCase
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
        $data['name'] = self::getFaker()->word;
        $data['description'] = self::getFaker()->word;
        $data['dateCreated'] = self::getFaker()->word;
        $data['dateLastSeen'] = self::getFaker()->word;
        $this->testInstance = new CharactersModel($data);
        $this->assertEquals($data['id'], $this->testInstance->getId());
        $this->assertEquals($data['uuid'], $this->testInstance->getUuid());
        $this->assertEquals($data['userId'], $this->testInstance->getUserId());
        $this->assertEquals($data['name'], $this->testInstance->getName());
        $this->assertEquals($data['description'], $this->testInstance->getDescription());
        $this->assertEquals($data['dateCreated'], $this->testInstance->getDateCreated());
        $this->assertEquals($data['dateLastSeen'], $this->testInstance->getDateLastSeen());
    }

    public function testGetRandom()
    {
        /** @var CharactersTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CharactersTableGateway::class);

        // If there is no data in the table, create some.
        if($table->getCount() == 0){
            $dummyObject = $table->getNewMockModelInstance();
            $table->save($dummyObject);
        }

        $characters = $table->fetchRandom();
        $this->assertTrue($characters instanceof CharactersModel, "Make sure that \"" . get_class($characters) . "\" matches \"CharactersModel\"") ;

        return $characters;
    }

    public function testNewMockModelInstance()
    {
        /** @var CharactersTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CharactersTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        $this->assertEquals('Spurt\Models\CharactersModel', get_class($newMockModel));

        return $newMockModel;
    }

    public function testNewModelFactory()
    {
        $instance = CharactersModel::factory();

        $this->assertEquals('Spurt\Models\CharactersModel', get_class($instance));
    }

    public function testSave()
    {
        /** @var CharactersTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CharactersTableGateway::class);
        /** @var Models\CharactersModel $mockModel */
        /** @var Models\CharactersModel $savedModel */
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
    public function testGetById(CharactersModel $characters)
    {
        /** @var charactersTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CharactersTableGateway::class);
        $results = $table->select(['id' => $characters->getId()]);
        $charactersRow = $results->current();
        $this->assertTrue($charactersRow instanceof CharactersModel);
    }

    /**
     * @depends testGetRandom
     */
    public function testSettersAndGetters(CharactersModel $characters)
    {
        $this->assertTrue(method_exists($characters, "getid"));
        $this->assertTrue(method_exists($characters, "setid"));
        $this->assertTrue(method_exists($characters, "getuuid"));
        $this->assertTrue(method_exists($characters, "setuuid"));
        $this->assertTrue(method_exists($characters, "getuserId"));
        $this->assertTrue(method_exists($characters, "setuserId"));
        $this->assertTrue(method_exists($characters, "getname"));
        $this->assertTrue(method_exists($characters, "setname"));
        $this->assertTrue(method_exists($characters, "getdescription"));
        $this->assertTrue(method_exists($characters, "setdescription"));
        $this->assertTrue(method_exists($characters, "getdateCreated"));
        $this->assertTrue(method_exists($characters, "setdateCreated"));
        $this->assertTrue(method_exists($characters, "getdateLastSeen"));
        $this->assertTrue(method_exists($characters, "setdateLastSeen"));

        $testCharacters = new CharactersModel();
        $input = self::getFaker()->randomDigitNotNull;
        $testCharacters->setid($input);
        $this->assertEquals($input, $testCharacters->getid());
        $input = self::getFaker()->word;
        $testCharacters->setuuid($input);
        $this->assertEquals($input, $testCharacters->getuuid());
        $input = self::getFaker()->randomDigitNotNull;
        $testCharacters->setuserId($input);
        $this->assertEquals($input, $testCharacters->getuserId());
        $input = self::getFaker()->word;
        $testCharacters->setname($input);
        $this->assertEquals($input, $testCharacters->getname());
        $input = self::getFaker()->word;
        $testCharacters->setdescription($input);
        $this->assertEquals($input, $testCharacters->getdescription());
        $input = self::getFaker()->word;
        $testCharacters->setdateCreated($input);
        $this->assertEquals($input, $testCharacters->getdateCreated());
        $input = self::getFaker()->word;
        $testCharacters->setdateLastSeen($input);
        $this->assertEquals($input, $testCharacters->getdateLastSeen());
    }


    public function testAutoincrementedIdIsApplied()
    {
        /** @var CharactersTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CharactersTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        // Set primary keys to null.
        $newMockModel->setid(null);

        // Save the object
        $newMockModel->save();

        // verify that the AI keys have been set.
        $this->assertNotNull($newMockModel->getId());
    }

}
