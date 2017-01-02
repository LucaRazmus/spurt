<?php
namespace Spurt\Test\Models;

use \Spurt\TableGateways\MessagesTableGateway;
use \Spurt\Models\MessagesModel;
use \Spurt\Models;

class MessagesTest extends \Segura\AppCore\Test\BaseTestCase
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
        $data['characterFromId'] = self::getFaker()->randomDigitNotNull;
        $data['characterToId'] = self::getFaker()->randomDigitNotNull;
        $data['message'] = self::getFaker()->word;
        $data['dateCreated'] = self::getFaker()->word;
        $data['dateRead'] = self::getFaker()->word;
        $this->testInstance = new MessagesModel($data);
        $this->assertEquals($data['id'], $this->testInstance->getId());
        $this->assertEquals($data['uuid'], $this->testInstance->getUuid());
        $this->assertEquals($data['characterFromId'], $this->testInstance->getCharacterFromId());
        $this->assertEquals($data['characterToId'], $this->testInstance->getCharacterToId());
        $this->assertEquals($data['message'], $this->testInstance->getMessage());
        $this->assertEquals($data['dateCreated'], $this->testInstance->getDateCreated());
        $this->assertEquals($data['dateRead'], $this->testInstance->getDateRead());
    }

    public function testGetRandom()
    {
        /** @var MessagesTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\MessagesTableGateway::class);

        // If there is no data in the table, create some.
        if($table->getCount() == 0){
            $dummyObject = $table->getNewMockModelInstance();
            $table->save($dummyObject);
        }

        $messages = $table->fetchRandom();
        $this->assertTrue($messages instanceof MessagesModel, "Make sure that \"" . get_class($messages) . "\" matches \"MessagesModel\"") ;

        return $messages;
    }

    public function testNewMockModelInstance()
    {
        /** @var MessagesTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\MessagesTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        $this->assertEquals('Spurt\Models\MessagesModel', get_class($newMockModel));

        return $newMockModel;
    }

    public function testNewModelFactory()
    {
        $instance = MessagesModel::factory();

        $this->assertEquals('Spurt\Models\MessagesModel', get_class($instance));
    }

    public function testSave()
    {
        /** @var MessagesTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\MessagesTableGateway::class);
        /** @var Models\MessagesModel $mockModel */
        /** @var Models\MessagesModel $savedModel */
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
    public function testGetById(MessagesModel $messages)
    {
        /** @var messagesTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\MessagesTableGateway::class);
        $results = $table->select(['id' => $messages->getId()]);
        $messagesRow = $results->current();
        $this->assertTrue($messagesRow instanceof MessagesModel);
    }

    /**
     * @depends testGetRandom
     */
    public function testSettersAndGetters(MessagesModel $messages)
    {
        $this->assertTrue(method_exists($messages, "getid"));
        $this->assertTrue(method_exists($messages, "setid"));
        $this->assertTrue(method_exists($messages, "getuuid"));
        $this->assertTrue(method_exists($messages, "setuuid"));
        $this->assertTrue(method_exists($messages, "getcharacterFromId"));
        $this->assertTrue(method_exists($messages, "setcharacterFromId"));
        $this->assertTrue(method_exists($messages, "getcharacterToId"));
        $this->assertTrue(method_exists($messages, "setcharacterToId"));
        $this->assertTrue(method_exists($messages, "getmessage"));
        $this->assertTrue(method_exists($messages, "setmessage"));
        $this->assertTrue(method_exists($messages, "getdateCreated"));
        $this->assertTrue(method_exists($messages, "setdateCreated"));
        $this->assertTrue(method_exists($messages, "getdateRead"));
        $this->assertTrue(method_exists($messages, "setdateRead"));

        $testMessages = new MessagesModel();
        $input = self::getFaker()->randomDigitNotNull;
        $testMessages->setid($input);
        $this->assertEquals($input, $testMessages->getid());
        $input = self::getFaker()->word;
        $testMessages->setuuid($input);
        $this->assertEquals($input, $testMessages->getuuid());
        $input = self::getFaker()->randomDigitNotNull;
        $testMessages->setcharacterFromId($input);
        $this->assertEquals($input, $testMessages->getcharacterFromId());
        $input = self::getFaker()->randomDigitNotNull;
        $testMessages->setcharacterToId($input);
        $this->assertEquals($input, $testMessages->getcharacterToId());
        $input = self::getFaker()->word;
        $testMessages->setmessage($input);
        $this->assertEquals($input, $testMessages->getmessage());
        $input = self::getFaker()->word;
        $testMessages->setdateCreated($input);
        $this->assertEquals($input, $testMessages->getdateCreated());
        $input = self::getFaker()->word;
        $testMessages->setdateRead($input);
        $this->assertEquals($input, $testMessages->getdateRead());
    }


    public function testAutoincrementedIdIsApplied()
    {
        /** @var MessagesTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\MessagesTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        // Set primary keys to null.
        $newMockModel->setid(null);

        // Save the object
        $newMockModel->save();

        // verify that the AI keys have been set.
        $this->assertNotNull($newMockModel->getId());
    }

}
