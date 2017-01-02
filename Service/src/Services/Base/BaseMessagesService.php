<?php
namespace Spurt\Services\Base;

use Segura\AppCore\Abstracts\Service as AbstractService;
use Segura\AppCore\Interfaces\ServiceInterface as ServiceInterface;
use \Spurt\TableGateways;
use \Spurt\Models;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

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
// @todo: Make all Services implement a ServicesInterface. - MB
abstract class BaseMessagesService
    extends AbstractService
    implements ServiceInterface
{

    // Related Objects Table Gateways
    /** @var TableGateways\CharactersTableGateway */
    protected $charactersTableGateway;

    // Remote Constraints Table Gateways

    // Self Table Gateway
    /** @var TableGateways\MessagesTableGateway */
    protected $messagesTableGateway;

    /**
     * Constructor.
     *
     * @param TableGateways\CharactersTableGateway $charactersTableGateway
     * @param TableGateways\MessagesTableGateway $messagesTableGateway
     */
    public function __construct(
        TableGateways\CharactersTableGateway $charactersTableGateway,
        TableGateways\MessagesTableGateway $messagesTableGateway
    )
    {
        $this->charactersTableGateway = $charactersTableGateway;
        $this->messagesTableGateway = $messagesTableGateway;
    }

    public function getNewTableGatewayInstance() : TableGateways\MessagesTableGateway
    {
        return $this->messagesTableGateway;
    }
    
    public function getNewModelInstance($dataExchange = []) : Models\MessagesModel
    {
        return $this->messagesTableGateway->getNewModelInstance($dataExchange);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @param array|null $wheres
     * @param string|null $order
     * @param string|null $orderDirection
     * @return Models\MessagesModel[]
     */
    public function getAll(
        int $limit = null,
        int $offset = null,
        array $wheres = null,
        string $order = null,
        string $orderDirection = null
    )
    {

        $messagesTable = $this->getNewTableGatewayInstance();
        list($allMessagess, $count) = $messagesTable->fetchAll(
            $limit,
            $offset,
            $wheres,
            $order,
            $orderDirection !== null ? $orderDirection : Select::ORDER_ASCENDING
        );
        $return = [];

        if ($allMessagess instanceof ResultSet) {
            foreach ($allMessagess as $messages) {
                $return[] = $messages;
            }
        }
        return $return;
    }

    /**
     * @param int $id
     * @return Models\MessagesModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getById(int $id) : Models\MessagesModel
    {
        /** @var TableGateways\MessagesTableGateway $messagesTable */
        $messagesTable = $this->getNewTableGatewayInstance();
        return $messagesTable->getById($id);
    }

    /**
     * @param string $field
     * @param $value
     * @return Models\MessagesModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getByField(string $field, $value) : Models\MessagesModel
    {
        /** @var TableGateways\MessagesTableGateway $messagesTable */
        $messagesTable = $this->getNewTableGatewayInstance();
        return $messagesTable->getByField($field, $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return Models\MessagesModel[]
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getManyByField(string $field, $value) : array
    {
        /** @var TableGateways\MessagesTableGateway $messagesTable */
        $messagesTable = $this->getNewTableGatewayInstance();
        return $messagesTable->getManyByField($field, $value);
    }

    /**
     * @return Models\MessagesModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getRandom() : Models\MessagesModel
    {
        /** @var TableGateways\MessagesTableGateway $messagesTable */
        $messagesTable = $this->getNewTableGatewayInstance();
        return $messagesTable->fetchRandom();
    }

    /**
     * @param $dataExchange
     * @return array|\ArrayObject|null
     */
    public function createFromArray($dataExchange)
    {
        /** @var TableGateways\MessagesTableGateway $messagesTable */
        $messagesTable = $this->getNewTableGatewayInstance();
        $messages = $this->getNewModelInstance($dataExchange);
        return $messagesTable->save($messages);
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteByID($id) : int
    {
        /** @var TableGateways\MessagesTableGateway $messagesTable */
        $messagesTable = $this->getNewTableGatewayInstance();
        return $messagesTable->delete(['id' => $id]);
    }

    public function getTermPlural() : string
    {
        return 'Messages';
    }

    public function getTermSingular() : string
    {
        return 'Messages';
    }

    /**
     * @returns Models\MessagesModel
     */
    public function getMockObject()
    {
        return $this->getNewTableGatewayInstance()->getNewMockModelInstance();
    }
}
