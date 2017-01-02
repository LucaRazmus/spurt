<?php
namespace Spurt\TableGateways\Base;
use \Segura\AppCore\Abstracts\TableGateway as AbstractTableGateway;
use \Segura\AppCore\Abstracts\Model;
use \Segura\AppCore\Db;
use \Spurt\TableGateways;
use \Spurt\Models;
use \Zend\Db\Adapter\AdapterInterface;
use \Zend\Db\ResultSet\ResultSet;

/********************************************************
 *             ___                         __           *
 *            / _ \___ ____  ___ ____ ____/ /           *
 *           / // / _ `/ _ \/ _ `/ -_) __/_/            *
 *          /____/\_,_/_//_/\_, /\__/_/ (_)             *
 *                         /___/                        *
 *                                                      *
 * Anything in this file is prone to being overwritten! *
 *                                                      *
 * This file was programatically generated. To modify   *
 * this classes behaviours, do so in the class that     *
 * extends this, or modify the Zenderator Template!     *
 ********************************************************/
// @todo: Make all TableGateways implement a TableGatewayInterface. -MB
abstract class BaseUsersTableGateway extends AbstractTableGateway
{
    protected $table = 'users';

    protected $database = 'Default';

    protected $model = 'Spurt\Models\UsersModel';

    /** @var \Faker\Generator */
    protected $faker;

    /** @var Db */
    private $databaseConnector;

    private $databaseAdaptor;


    /**
     * AbstractTableGateway constructor.
     *
     * @param Db $databaseConnector
     */
    public function __construct(
        \Faker\Generator $faker,
        Db $databaseConnector
    )
    {
        $this->faker = $faker;
        $this->databaseConnector = $databaseConnector;

        /** @var $adaptor AdapterInterface */
        // @todo rename all uses of 'adaptor' to 'adapter'. I cannot spell - MB
        $this->databaseAdaptor = $this->databaseConnector->getDatabase($this->database);
        $resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAYOBJECT, new $this->model);
        return parent::__construct($this->table, $this->databaseAdaptor, null, $resultSetPrototype);
    }

    /**
     * @return Models\UsersModel
     */
    public function getNewMockModelInstance()
    {

      $newUsersData = [
        // dateCreated. Type = datetime. PHPType = string. Has no related objects.
        'dateCreated' => $this->faker->dateTime()->format("Y-m-d H:i:s"), // @todo: Make datetime fields accept DateTime objects instead of strings. - MB
        // dateLastSeen. Type = datetime. PHPType = string. Has no related objects.
        'dateLastSeen' => $this->faker->dateTime()->format("Y-m-d H:i:s"), // @todo: Make datetime fields accept DateTime objects instead of strings. - MB
        // email. Type = varchar. PHPType = string. Has no related objects.
        'email' => substr($this->faker->text(320 >= 5 ? 320 : 5), 0, 320),
        // id. Type = int. PHPType = int. Has no related objects.
        'id' => null,
        // password. Type = varchar. PHPType = string. Has no related objects.
        'password' => substr($this->faker->text(60 >= 5 ? 60 : 5), 0, 60),
        // state. Type = enum. PHPType = string. Has no related objects.
        'state' => 'unconfirmed',
        // username. Type = varchar. PHPType = string. Has no related objects.
        'username' => substr($this->faker->text(255 >= 5 ? 255 : 5), 0, 255),
        // uuid. Type = varchar. PHPType = string. Has no related objects.
        'uuid' => substr($this->faker->text(36 >= 5 ? 36 : 5), 0, 36),
      ];
      $newUsers = $this->getNewModelInstance($newUsersData);
      return $newUsers;
    }

    /**
     * @param array $data
     * @return Models\UsersModel
     */
    public function getNewModelInstance(array $data = [])
    {
        return parent::getNewModelInstance($data);
    }

    /**
     * @param Models\UsersModel $model
     * @return Models\UsersModel
     */
    public function save(Model $model)
    {
        return parent::save($model);
    }
}