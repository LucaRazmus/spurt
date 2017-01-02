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
abstract class BaseCausesTableGateway extends AbstractTableGateway
{
    protected $table = 'causes';

    protected $database = 'Default';

    protected $model = 'Spurt\Models\CausesModel';

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
     * @return Models\CausesModel
     */
    public function getNewMockModelInstance()
    {

      $newCausesData = [
        // id. Type = int. PHPType = int. Has no related objects.
        'id' => null,
        // name. Type = varchar. PHPType = string. Has no related objects.
        'name' => substr($this->faker->text(320 >= 5 ? 320 : 5), 0, 320),
      ];
      $newCauses = $this->getNewModelInstance($newCausesData);
      return $newCauses;
    }

    /**
     * @param array $data
     * @return Models\CausesModel
     */
    public function getNewModelInstance(array $data = [])
    {
        return parent::getNewModelInstance($data);
    }

    /**
     * @param Models\CausesModel $model
     * @return Models\CausesModel
     */
    public function save(Model $model)
    {
        return parent::save($model);
    }
}