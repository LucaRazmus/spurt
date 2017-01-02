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
abstract class BaseCharactersTableGateway extends AbstractTableGateway
{
    protected $table = 'characters';

    protected $database = 'Default';

    protected $model = 'Spurt\Models\CharactersModel';

    /** @var \Faker\Generator */
    protected $faker;

    /** @var Db */
    private $databaseConnector;

    private $databaseAdaptor;

    /** @var TableGateways\UsersTableGateway */
    protected $usersTableGateway;

    /**
     * AbstractTableGateway constructor.
     *
     * @param TableGateways\UsersTableGateway $usersTableGateway,
     * @param Db $databaseConnector
     */
    public function __construct(
        TableGateways\UsersTableGateway $usersTableGateway,
        \Faker\Generator $faker,
        Db $databaseConnector
    )
    {
        $this->usersTableGateway = $usersTableGateway;
        $this->faker = $faker;
        $this->databaseConnector = $databaseConnector;

        /** @var $adaptor AdapterInterface */
        // @todo rename all uses of 'adaptor' to 'adapter'. I cannot spell - MB
        $this->databaseAdaptor = $this->databaseConnector->getDatabase($this->database);
        $resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAYOBJECT, new $this->model);
        return parent::__construct($this->table, $this->databaseAdaptor, null, $resultSetPrototype);
    }

    /**
     * @return Models\CharactersModel
     */
    public function getNewMockModelInstance()
    {

      $newCharactersData = [
        // dateCreated. Type = datetime. PHPType = string. Has no related objects.
        'dateCreated' => $this->faker->dateTime()->format("Y-m-d H:i:s"), // @todo: Make datetime fields accept DateTime objects instead of strings. - MB
        // dateLastSeen. Type = datetime. PHPType = string. Has no related objects.
        'dateLastSeen' => $this->faker->dateTime()->format("Y-m-d H:i:s"), // @todo: Make datetime fields accept DateTime objects instead of strings. - MB
        // description. Type = text. PHPType = string. Has no related objects.
        'description' => substr($this->faker->text(500 >= 5 ? 500 : 5), 0, 500),
        // id. Type = int. PHPType = int. Has no related objects.
        'id' => null,
        // name. Type = varchar. PHPType = string. Has no related objects.
        'name' => substr($this->faker->text(320 >= 5 ? 320 : 5), 0, 320),
        // userId. Type = int. PHPType = int. Has related objects.
        'userId' =>
            $this->usersTableGateway->fetchRandom() instanceof Models\UsersModel
            ? $this->usersTableGateway->fetchRandom()->getId()
            : $this->usersTableGateway->getNewMockModelInstance()->save()->getId(),

        // uuid. Type = varchar. PHPType = string. Has no related objects.
        'uuid' => substr($this->faker->text(36 >= 5 ? 36 : 5), 0, 36),
      ];
      $newCharacters = $this->getNewModelInstance($newCharactersData);
      return $newCharacters;
    }

    /**
     * @param array $data
     * @return Models\CharactersModel
     */
    public function getNewModelInstance(array $data = [])
    {
        return parent::getNewModelInstance($data);
    }

    /**
     * @param Models\CharactersModel $model
     * @return Models\CharactersModel
     */
    public function save(Model $model)
    {
        return parent::save($model);
    }
}