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
abstract class BaseUsersService
    extends AbstractService
    implements ServiceInterface
{

    // Related Objects Table Gateways

    // Remote Constraints Table Gateways

    // Self Table Gateway
    /** @var TableGateways\UsersTableGateway */
    protected $usersTableGateway;

    /**
     * Constructor.
     *
     * @param TableGateways\UsersTableGateway $usersTableGateway
     */
    public function __construct(
        TableGateways\UsersTableGateway $usersTableGateway
    )
    {
        $this->usersTableGateway = $usersTableGateway;
    }

    public function getNewTableGatewayInstance() : TableGateways\UsersTableGateway
    {
        return $this->usersTableGateway;
    }
    
    public function getNewModelInstance($dataExchange = []) : Models\UsersModel
    {
        return $this->usersTableGateway->getNewModelInstance($dataExchange);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @param array|null $wheres
     * @param string|null $order
     * @param string|null $orderDirection
     * @return Models\UsersModel[]
     */
    public function getAll(
        int $limit = null,
        int $offset = null,
        array $wheres = null,
        string $order = null,
        string $orderDirection = null
    )
    {

        $usersTable = $this->getNewTableGatewayInstance();
        list($allUserss, $count) = $usersTable->fetchAll(
            $limit,
            $offset,
            $wheres,
            $order,
            $orderDirection !== null ? $orderDirection : Select::ORDER_ASCENDING
        );
        $return = [];

        if ($allUserss instanceof ResultSet) {
            foreach ($allUserss as $users) {
                $return[] = $users;
            }
        }
        return $return;
    }

    /**
     * @param int $id
     * @return Models\UsersModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getById(int $id) : Models\UsersModel
    {
        /** @var TableGateways\UsersTableGateway $usersTable */
        $usersTable = $this->getNewTableGatewayInstance();
        return $usersTable->getById($id);
    }

    /**
     * @param string $field
     * @param $value
     * @return Models\UsersModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getByField(string $field, $value) : Models\UsersModel
    {
        /** @var TableGateways\UsersTableGateway $usersTable */
        $usersTable = $this->getNewTableGatewayInstance();
        return $usersTable->getByField($field, $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return Models\UsersModel[]
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getManyByField(string $field, $value) : array
    {
        /** @var TableGateways\UsersTableGateway $usersTable */
        $usersTable = $this->getNewTableGatewayInstance();
        return $usersTable->getManyByField($field, $value);
    }

    /**
     * @return Models\UsersModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getRandom() : Models\UsersModel
    {
        /** @var TableGateways\UsersTableGateway $usersTable */
        $usersTable = $this->getNewTableGatewayInstance();
        return $usersTable->fetchRandom();
    }

    /**
     * @param $dataExchange
     * @return array|\ArrayObject|null
     */
    public function createFromArray($dataExchange)
    {
        /** @var TableGateways\UsersTableGateway $usersTable */
        $usersTable = $this->getNewTableGatewayInstance();
        $users = $this->getNewModelInstance($dataExchange);
        return $usersTable->save($users);
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteByID($id) : int
    {
        /** @var TableGateways\UsersTableGateway $usersTable */
        $usersTable = $this->getNewTableGatewayInstance();
        return $usersTable->delete(['id' => $id]);
    }

    public function getTermPlural() : string
    {
        return 'Users';
    }

    public function getTermSingular() : string
    {
        return 'Users';
    }

    /**
     * @returns Models\UsersModel
     */
    public function getMockObject()
    {
        return $this->getNewTableGatewayInstance()->getNewMockModelInstance();
    }
}
