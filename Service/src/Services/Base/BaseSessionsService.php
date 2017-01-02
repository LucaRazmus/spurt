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
abstract class BaseSessionsService
    extends AbstractService
    implements ServiceInterface
{

    // Related Objects Table Gateways

    // Remote Constraints Table Gateways

    // Self Table Gateway
    /** @var TableGateways\SessionsTableGateway */
    protected $sessionsTableGateway;

    /**
     * Constructor.
     *
     * @param TableGateways\SessionsTableGateway $sessionsTableGateway
     */
    public function __construct(
        TableGateways\SessionsTableGateway $sessionsTableGateway
    )
    {
        $this->sessionsTableGateway = $sessionsTableGateway;
    }

    public function getNewTableGatewayInstance() : TableGateways\SessionsTableGateway
    {
        return $this->sessionsTableGateway;
    }
    
    public function getNewModelInstance($dataExchange = []) : Models\SessionsModel
    {
        return $this->sessionsTableGateway->getNewModelInstance($dataExchange);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @param array|null $wheres
     * @param string|null $order
     * @param string|null $orderDirection
     * @return Models\SessionsModel[]
     */
    public function getAll(
        int $limit = null,
        int $offset = null,
        array $wheres = null,
        string $order = null,
        string $orderDirection = null
    )
    {

        $sessionsTable = $this->getNewTableGatewayInstance();
        list($allSessionss, $count) = $sessionsTable->fetchAll(
            $limit,
            $offset,
            $wheres,
            $order,
            $orderDirection !== null ? $orderDirection : Select::ORDER_ASCENDING
        );
        $return = [];

        if ($allSessionss instanceof ResultSet) {
            foreach ($allSessionss as $sessions) {
                $return[] = $sessions;
            }
        }
        return $return;
    }

    /**
     * @param int $id
     * @return Models\SessionsModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getById(int $id) : Models\SessionsModel
    {
        /** @var TableGateways\SessionsTableGateway $sessionsTable */
        $sessionsTable = $this->getNewTableGatewayInstance();
        return $sessionsTable->getById($id);
    }

    /**
     * @param string $field
     * @param $value
     * @param $orderBy string Field to sort by
     * @param $orderDirection string Direction to sort (Select::ORDER_ASCENDING || Select::ORDER_DESCENDING)
     * @return Models\SessionsModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getByField(string $field, $value, $orderBy = null, $orderDirection = Select::ORDER_ASCENDING) : Models\SessionsModel
    {
        /** @var TableGateways\SessionsTableGateway $sessionsTable */
        $sessionsTable = $this->getNewTableGatewayInstance();
        return $sessionsTable->getByField($field, $value, $orderBy, $orderDirection);
    }

    /**
     * @param string $field
     * @param $value
     * @param $orderBy string Field to sort by
     * @param $orderDirection string Direction to sort (Select::ORDER_ASCENDING || Select::ORDER_DESCENDING)
     * @return Models\SessionsModel[]
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getManyByField(string $field, $value, $orderBy = null, $orderDirection = Select::ORDER_ASCENDING) : array
    {
        /** @var TableGateways\SessionsTableGateway $sessionsTable */
        $sessionsTable = $this->getNewTableGatewayInstance();
        return $sessionsTable->getManyByField($field, $value, $orderBy, $orderDirection);
    }

    /**
     * @return Models\SessionsModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getRandom() : Models\SessionsModel
    {
        /** @var TableGateways\SessionsTableGateway $sessionsTable */
        $sessionsTable = $this->getNewTableGatewayInstance();
        return $sessionsTable->fetchRandom();
    }

    /**
     * @param $dataExchange
     * @return array|\ArrayObject|null
     */
    public function createFromArray($dataExchange)
    {
        /** @var TableGateways\SessionsTableGateway $sessionsTable */
        $sessionsTable = $this->getNewTableGatewayInstance();
        $sessions = $this->getNewModelInstance($dataExchange);
        return $sessionsTable->save($sessions);
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteByID($id) : int
    {
        /** @var TableGateways\SessionsTableGateway $sessionsTable */
        $sessionsTable = $this->getNewTableGatewayInstance();
        return $sessionsTable->delete(['id' => $id]);
    }

    public function getTermPlural() : string
    {
        return 'Sessions';
    }

    public function getTermSingular() : string
    {
        return 'Sessions';
    }

    /**
     * @returns Models\SessionsModel
     */
    public function getMockObject()
    {
        return $this->getNewTableGatewayInstance()->getNewMockModelInstance();
    }
}
