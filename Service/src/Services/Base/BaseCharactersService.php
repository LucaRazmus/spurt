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
abstract class BaseCharactersService
    extends AbstractService
    implements ServiceInterface
{

    // Related Objects Table Gateways
    /** @var TableGateways\UsersTableGateway */
    protected $usersTableGateway;

    // Remote Constraints Table Gateways

    // Self Table Gateway
    /** @var TableGateways\CharactersTableGateway */
    protected $charactersTableGateway;

    /**
     * Constructor.
     *
     * @param TableGateways\UsersTableGateway $usersTableGateway
     * @param TableGateways\CharactersTableGateway $charactersTableGateway
     */
    public function __construct(
        TableGateways\UsersTableGateway $usersTableGateway,
        TableGateways\CharactersTableGateway $charactersTableGateway
    )
    {
        $this->usersTableGateway = $usersTableGateway;
        $this->charactersTableGateway = $charactersTableGateway;
    }

    public function getNewTableGatewayInstance() : TableGateways\CharactersTableGateway
    {
        return $this->charactersTableGateway;
    }
    
    public function getNewModelInstance($dataExchange = []) : Models\CharactersModel
    {
        return $this->charactersTableGateway->getNewModelInstance($dataExchange);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @param array|null $wheres
     * @param string|null $order
     * @param string|null $orderDirection
     * @return Models\CharactersModel[]
     */
    public function getAll(
        int $limit = null,
        int $offset = null,
        array $wheres = null,
        string $order = null,
        string $orderDirection = null
    )
    {

        $charactersTable = $this->getNewTableGatewayInstance();
        list($allCharacterss, $count) = $charactersTable->fetchAll(
            $limit,
            $offset,
            $wheres,
            $order,
            $orderDirection !== null ? $orderDirection : Select::ORDER_ASCENDING
        );
        $return = [];

        if ($allCharacterss instanceof ResultSet) {
            foreach ($allCharacterss as $characters) {
                $return[] = $characters;
            }
        }
        return $return;
    }

    /**
     * @param int $id
     * @return Models\CharactersModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getById(int $id) : Models\CharactersModel
    {
        /** @var TableGateways\CharactersTableGateway $charactersTable */
        $charactersTable = $this->getNewTableGatewayInstance();
        return $charactersTable->getById($id);
    }

    /**
     * @param string $field
     * @param $value
     * @return Models\CharactersModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getByField(string $field, $value) : Models\CharactersModel
    {
        /** @var TableGateways\CharactersTableGateway $charactersTable */
        $charactersTable = $this->getNewTableGatewayInstance();
        return $charactersTable->getByField($field, $value);
    }

    /**
     * @param string $field
     * @param $value
     * @return Models\CharactersModel[]
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getManyByField(string $field, $value) : array
    {
        /** @var TableGateways\CharactersTableGateway $charactersTable */
        $charactersTable = $this->getNewTableGatewayInstance();
        return $charactersTable->getManyByField($field, $value);
    }

    /**
     * @return Models\CharactersModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getRandom() : Models\CharactersModel
    {
        /** @var TableGateways\CharactersTableGateway $charactersTable */
        $charactersTable = $this->getNewTableGatewayInstance();
        return $charactersTable->fetchRandom();
    }

    /**
     * @param $dataExchange
     * @return array|\ArrayObject|null
     */
    public function createFromArray($dataExchange)
    {
        /** @var TableGateways\CharactersTableGateway $charactersTable */
        $charactersTable = $this->getNewTableGatewayInstance();
        $characters = $this->getNewModelInstance($dataExchange);
        return $charactersTable->save($characters);
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteByID($id) : int
    {
        /** @var TableGateways\CharactersTableGateway $charactersTable */
        $charactersTable = $this->getNewTableGatewayInstance();
        return $charactersTable->delete(['id' => $id]);
    }

    public function getTermPlural() : string
    {
        return 'Characters';
    }

    public function getTermSingular() : string
    {
        return 'Characters';
    }

    /**
     * @returns Models\CharactersModel
     */
    public function getMockObject()
    {
        return $this->getNewTableGatewayInstance()->getNewMockModelInstance();
    }
}
