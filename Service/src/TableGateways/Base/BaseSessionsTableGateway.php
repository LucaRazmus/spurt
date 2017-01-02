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
abstract class BaseSessionsTableGateway extends AbstractTableGateway
{
    protected $table = 'sessions';

    protected $database = 'Default';

    protected $model = 'Spurt\Models\SessionsModel';

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
     * @return Models\SessionsModel
     */
    public function getNewMockModelInstance()
    {

      $newSessionsData = [
        // end. Type = datetime. PHPType = string. Has no related objects.
        'end' => $this->faker->dateTime()->format("Y-m-d H:i:s"), // @todo: Make datetime fields accept DateTime objects instead of strings. - MB
        // id. Type = int. PHPType = int. Has no related objects.
        'id' => null,
        // start. Type = datetime. PHPType = string. Has no related objects.
        'start' => $this->faker->dateTime()->format("Y-m-d H:i:s"), // @todo: Make datetime fields accept DateTime objects instead of strings. - MB
        // userId. Type = int. PHPType = int. Has no related objects.
        'userId' => $this->faker->numberBetween(1, 100000000),
      ];
      $newSessions = $this->getNewModelInstance($newSessionsData);
      return $newSessions;
    }

    /**
     * @param array $data
     * @return Models\SessionsModel
     */
    public function getNewModelInstance(array $data = [])
    {
        return parent::getNewModelInstance($data);
    }

    /**
     * @param Models\SessionsModel $model
     * @return Models\SessionsModel
     */
    public function save(Model $model)
    {
        return parent::save($model);
    }
}