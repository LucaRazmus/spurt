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
abstract class BaseOrgasmsTableGateway extends AbstractTableGateway
{
    protected $table = 'orgasms';

    protected $database = 'Default';

    protected $model = 'Spurt\Models\OrgasmsModel';

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
     * @return Models\OrgasmsModel
     */
    public function getNewMockModelInstance()
    {

      $newOrgasmsData = [
        // datetime. Type = datetime. PHPType = string. Has no related objects.
        'datetime' => $this->faker->dateTime()->format("Y-m-d H:i:s"), // @todo: Make datetime fields accept DateTime objects instead of strings. - MB
        // id. Type = int. PHPType = int. Has no related objects.
        'id' => null,
        // user_id. Type = int. PHPType = int. Has related objects.
        'user_id' =>
            $this->usersTableGateway->fetchRandom() instanceof Models\UsersModel
            ? $this->usersTableGateway->fetchRandom()->getId()
            : $this->usersTableGateway->getNewMockModelInstance()->save()->getId(),

      ];
      $newOrgasms = $this->getNewModelInstance($newOrgasmsData);
      return $newOrgasms;
    }

    /**
     * @param array $data
     * @return Models\OrgasmsModel
     */
    public function getNewModelInstance(array $data = [])
    {
        return parent::getNewModelInstance($data);
    }

    /**
     * @param Models\OrgasmsModel $model
     * @return Models\OrgasmsModel
     */
    public function save(Model $model)
    {
        return parent::save($model);
    }
}