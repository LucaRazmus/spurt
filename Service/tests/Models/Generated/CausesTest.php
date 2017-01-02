<?php
namespace Spurt\Test\Models;

use \Spurt\TableGateways\CausesTableGateway;
use \Spurt\Models\CausesModel;
use \Spurt\Models;

class CausesTest extends \Segura\AppCore\Test\BaseTestCase
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
        $data['name'] = self::getFaker()->word;
        $this->testInstance = new CausesModel($data);
        $this->assertEquals($data['id'], $this->testInstance->getId());
        $this->assertEquals($data['name'], $this->testInstance->getName());
    }

    public function testGetRandom()
    {
        /** @var CausesTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CausesTableGateway::class);

        // If there is no data in the table, create some.
        if($table->getCount() == 0){
            $dummyObject = $table->getNewMockModelInstance();
            $table->save($dummyObject);
        }

        $causes = $table->fetchRandom();
        $this->assertTrue($causes instanceof CausesModel, "Make sure that \"" . get_class($causes) . "\" matches \"CausesModel\"") ;

        return $causes;
    }

    public function testNewMockModelInstance()
    {
        /** @var CausesTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CausesTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        $this->assertEquals('Spurt\Models\CausesModel', get_class($newMockModel));

        return $newMockModel;
    }

    public function testNewModelFactory()
    {
        $instance = CausesModel::factory();

        $this->assertEquals('Spurt\Models\CausesModel', get_class($instance));
    }

    public function testSave()
    {
        /** @var CausesTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CausesTableGateway::class);
        /** @var Models\CausesModel $mockModel */
        /** @var Models\CausesModel $savedModel */
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
    public function testGetById(CausesModel $causes)
    {
        /** @var causesTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CausesTableGateway::class);
        $results = $table->select(['id' => $causes->getId()]);
        $causesRow = $results->current();
        $this->assertTrue($causesRow instanceof CausesModel);
    }

    /**
     * @depends testGetRandom
     */
    public function testSettersAndGetters(CausesModel $causes)
    {
        $this->assertTrue(method_exists($causes, "getid"));
        $this->assertTrue(method_exists($causes, "setid"));
        $this->assertTrue(method_exists($causes, "getname"));
        $this->assertTrue(method_exists($causes, "setname"));

        $testCauses = new CausesModel();
        $input = self::getFaker()->randomDigitNotNull;
        $testCauses->setid($input);
        $this->assertEquals($input, $testCauses->getid());
        $input = self::getFaker()->word;
        $testCauses->setname($input);
        $this->assertEquals($input, $testCauses->getname());
    }


    public function testAutoincrementedIdIsApplied()
    {
        /** @var CausesTableGateway $table */
        $table = $this->getDIContainer()->get(\Spurt\TableGateways\CausesTableGateway::class);
        $newMockModel = $table->getNewMockModelInstance();

        // Set primary keys to null.
        $newMockModel->setid(null);

        // Save the object
        $newMockModel->save();

        // verify that the AI keys have been set.
        $this->assertNotNull($newMockModel->getId());
    }

}
