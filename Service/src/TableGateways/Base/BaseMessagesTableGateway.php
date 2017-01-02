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
abstract class BaseMessagesTableGateway extends AbstractTableGateway
{
    protected $table = 'messages';

    protected $database = 'Default';

    protected $model = 'Spurt\Models\MessagesModel';

    /** @var \Faker\Generator */
    protected $faker;

    /** @var Db */
    private $databaseConnector;

    private $databaseAdaptor;

    /** @var TableGateways\CharactersTableGateway */
    protected $charactersTableGateway;

    /**
     * AbstractTableGateway constructor.
     *
     * @param TableGateways\CharactersTableGateway $charactersTableGateway,
     * @param Db $databaseConnector
     */
    public function __construct(
        TableGateways\CharactersTableGateway $charactersTableGateway,
        \Faker\Generator $faker,
        Db $databaseConnector
    )
    {
        $this->charactersTableGateway = $charactersTableGateway;
        $this->faker = $faker;
        $this->databaseConnector = $databaseConnector;

        /** @var $adaptor AdapterInterface */
        // @todo rename all uses of 'adaptor' to 'adapter'. I cannot spell - MB
        $this->databaseAdaptor = $this->databaseConnector->getDatabase($this->database);
        $resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAYOBJECT, new $this->model);
        return parent::__construct($this->table, $this->databaseAdaptor, null, $resultSetPrototype);
    }

    /**
     * @return Models\MessagesModel
     */
    public function getNewMockModelInstance()
    {

      $newMessagesData = [
        // characterFromId. Type = int. PHPType = int. Has related objects.
        'characterFromId' =>
            $this->charactersTableGateway->fetchRandom() instanceof Models\CharactersModel
            ? $this->charactersTableGateway->fetchRandom()->getId()
            : $this->charactersTableGateway->getNewMockModelInstance()->save()->getId(),

        // characterToId. Type = int. PHPType = int. Has related objects.
        'characterToId' =>
            $this->charactersTableGateway->fetchRandom() instanceof Models\CharactersModel
            ? $this->charactersTableGateway->fetchRandom()->getId()
            : $this->charactersTableGateway->getNewMockModelInstance()->save()->getId(),

        // dateCreated. Type = datetime. PHPType = string. Has no related objects.
        'dateCreated' => $this->faker->dateTime()->format("Y-m-d H:i:s"), // @todo: Make datetime fields accept DateTime objects instead of strings. - MB
        // dateRead. Type = datetime. PHPType = string. Has no related objects.
        'dateRead' => $this->faker->dateTime()->format("Y-m-d H:i:s"), // @todo: Make datetime fields accept DateTime objects instead of strings. - MB
        // id. Type = int. PHPType = int. Has no related objects.
        'id' => null,
        // message. Type = text. PHPType = string. Has no related objects.
        'message' => substr($this->faker->text(500 >= 5 ? 500 : 5), 0, 500),
        // uuid. Type = varchar. PHPType = string. Has no related objects.
        'uuid' => substr($this->faker->text(36 >= 5 ? 36 : 5), 0, 36),
      ];
      $newMessages = $this->getNewModelInstance($newMessagesData);
      return $newMessages;
    }

    /**
     * @param array $data
     * @return Models\MessagesModel
     */
    public function getNewModelInstance(array $data = [])
    {
        return parent::getNewModelInstance($data);
    }

    /**
     * @param Models\MessagesModel $model
     * @return Models\MessagesModel
     */
    public function save(Model $model)
    {
        return parent::save($model);
    }
}