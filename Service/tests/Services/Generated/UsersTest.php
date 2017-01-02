<?php
namespace Spurt\Test\Services;

use \Spurt\Spurt as App;
use \Spurt\TableGateways\UsersTableGateway;
use \Spurt\Services\UsersService;
use \Spurt\Models\UsersModel;

class UsersTest extends \Segura\AppCore\Test\BaseTestCase
{
    public static function setUpBeforeClass()
    {
        $usersTableGateway = App::Container()->get(UsersTableGateway::class);
        parent::setUpBeforeClass();

        for($i = 0; $i <= 5; $i++){
            $usersTableGateway
                ->getNewMockModelInstance()
                ->save();
        }
    }

    /**
     * @large
     */
    public function testGetAll()
    {
        $usersService = App::Container()->get(UsersService::class);
        $all = $usersService->getAll();
        $this->assertEquals('Spurt\Models\UsersModel', get_class(reset($all)));
    }

    public function testGetRandom()
    {
        $usersService = App::Container()->get(UsersService::class);

        $random = $usersService->getRandom();
        $this->assertEquals(
            'Spurt\Models\UsersModel',
            get_class($random)
        );

        return $random;
    }

    public function testGetMockObject()
    {
        $usersService = App::Container()->get(UsersService::class);
        $this->assertEquals(
            'Spurt\Models\UsersModel',
            get_class($usersService->getMockObject())
        );
    }

    /**
     * @depends testGetRandom
     */
    public function testGetByField(UsersModel $random)
    {
        $usersService = App::Container()->get(UsersService::class);
        $found = $usersService->getByField('id', $random->getid());
        $this->assertEquals(
            'Spurt\Models\UsersModel',
            get_class($found)
        );
        $found = $usersService->getByField('username', $random->getusername());
        $this->assertEquals(
            'Spurt\Models\UsersModel',
            get_class($found)
        );
        $found = $usersService->getByField('email', $random->getemail());
        $this->assertEquals(
            'Spurt\Models\UsersModel',
            get_class($found)
        );
        $found = $usersService->getByField('password', $random->getpassword());
        $this->assertEquals(
            'Spurt\Models\UsersModel',
            get_class($found)
        );
        $found = $usersService->getByField('dataIsPrivate', $random->getdataIsPrivate());
        $this->assertEquals(
            'Spurt\Models\UsersModel',
            get_class($found)
        );
        $found = $usersService->getByField('createdDate', $random->getcreatedDate());
        $this->assertEquals(
            'Spurt\Models\UsersModel',
            get_class($found)
        );
        $found = $usersService->getByField('lastUpdatedDate', $random->getlastUpdatedDate());
        $this->assertEquals(
            'Spurt\Models\UsersModel',
            get_class($found)
        );
    }

    public function testGetTermPlural()
    {
        $usersService = App::Container()->get(UsersService::class);
        $this->assertNotEmpty($usersService->getTermPlural());
    }

    public function testGetTermSingular()
    {
        $usersService = App::Container()->get(UsersService::class);
        $this->assertNotEmpty($usersService->getTermSingular());
    }
}
