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
abstract class BaseOrgasmsService
    extends AbstractService
    implements ServiceInterface
{

    // Related Objects Table Gateways
    /** @var TableGateways\UsersTableGateway */
    protected $usersTableGateway;

    // Remote Constraints Table Gateways

    // Self Table Gateway
    /** @var TableGateways\OrgasmsTableGateway */
    protected $orgasmsTableGateway;

    /**
     * Constructor.
     *
     * @param TableGateways\UsersTableGateway $usersTableGateway
     * @param TableGateways\OrgasmsTableGateway $orgasmsTableGateway
     */
    public function __construct(
        TableGateways\UsersTableGateway $usersTableGateway,
        TableGateways\OrgasmsTableGateway $orgasmsTableGateway
    )
    {
        $this->usersTableGateway = $usersTableGateway;
        $this->orgasmsTableGateway = $orgasmsTableGateway;
    }

    public function getNewTableGatewayInstance() : TableGateways\OrgasmsTableGateway
    {
        return $this->orgasmsTableGateway;
    }
    
    public function getNewModelInstance($dataExchange = []) : Models\OrgasmsModel
    {
        return $this->orgasmsTableGateway->getNewModelInstance($dataExchange);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @param array|null $wheres
     * @param string|null $order
     * @param string|null $orderDirection
     * @return Models\OrgasmsModel[]
     */
    public function getAll(
        int $limit = null,
        int $offset = null,
        array $wheres = null,
        string $order = null,
        string $orderDirection = null
    )
    {

        $orgasmsTable = $this->getNewTableGatewayInstance();
        list($allOrgasmss, $count) = $orgasmsTable->fetchAll(
            $limit,
            $offset,
            $wheres,
            $order,
            $orderDirection !== null ? $orderDirection : Select::ORDER_ASCENDING
        );
        $return = [];

        if ($allOrgasmss instanceof ResultSet) {
            foreach ($allOrgasmss as $orgasms) {
                $return[] = $orgasms;
            }
        }
        return $return;
    }

    /**
     * @param int $id
     * @return Models\OrgasmsModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getById(int $id) : Models\OrgasmsModel
    {
        /** @var TableGateways\OrgasmsTableGateway $orgasmsTable */
        $orgasmsTable = $this->getNewTableGatewayInstance();
        return $orgasmsTable->getById($id);
    }

    /**
     * @param string $field
     * @param $value
     * @param $orderBy string Field to sort by
     * @param $orderDirection string Direction to sort (Select::ORDER_ASCENDING || Select::ORDER_DESCENDING)
     * @return Models\OrgasmsModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getByField(string $field, $value, $orderBy = null, $orderDirection = Select::ORDER_ASCENDING) : Models\OrgasmsModel
    {
        /** @var TableGateways\OrgasmsTableGateway $orgasmsTable */
        $orgasmsTable = $this->getNewTableGatewayInstance();
        return $orgasmsTable->getByField($field, $value, $orderBy, $orderDirection);
    }

    /**
     * @param string $field
     * @param $value
     * @param $orderBy string Field to sort by
     * @param $orderDirection string Direction to sort (Select::ORDER_ASCENDING || Select::ORDER_DESCENDING)
     * @return Models\OrgasmsModel[]
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getManyByField(string $field, $value, $orderBy = null, $orderDirection = Select::ORDER_ASCENDING) : array
    {
        /** @var TableGateways\OrgasmsTableGateway $orgasmsTable */
        $orgasmsTable = $this->getNewTableGatewayInstance();
        return $orgasmsTable->getManyByField($field, $value, $orderBy, $orderDirection);
    }

    /**
     * @return Models\OrgasmsModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getRandom() : Models\OrgasmsModel
    {
        /** @var TableGateways\OrgasmsTableGateway $orgasmsTable */
        $orgasmsTable = $this->getNewTableGatewayInstance();
        return $orgasmsTable->fetchRandom();
    }

    /**
     * @param $dataExchange
     * @return array|\ArrayObject|null
     */
    public function createFromArray($dataExchange)
    {
        /** @var TableGateways\OrgasmsTableGateway $orgasmsTable */
        $orgasmsTable = $this->getNewTableGatewayInstance();
        $orgasms = $this->getNewModelInstance($dataExchange);
        return $orgasmsTable->save($orgasms);
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteByID($id) : int
    {
        /** @var TableGateways\OrgasmsTableGateway $orgasmsTable */
        $orgasmsTable = $this->getNewTableGatewayInstance();
        return $orgasmsTable->delete(['id' => $id]);
    }

    public function getTermPlural() : string
    {
        return 'Orgasms';
    }

    public function getTermSingular() : string
    {
        return 'Orgasms';
    }

    /**
     * @returns Models\OrgasmsModel
     */
    public function getMockObject()
    {
        return $this->getNewTableGatewayInstance()->getNewMockModelInstance();
    }
}
