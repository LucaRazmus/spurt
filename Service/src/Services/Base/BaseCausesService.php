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
abstract class BaseCausesService
    extends AbstractService
    implements ServiceInterface
{

    // Related Objects Table Gateways

    // Remote Constraints Table Gateways

    // Self Table Gateway
    /** @var TableGateways\CausesTableGateway */
    protected $causesTableGateway;

    /**
     * Constructor.
     *
     * @param TableGateways\CausesTableGateway $causesTableGateway
     */
    public function __construct(
        TableGateways\CausesTableGateway $causesTableGateway
    )
    {
        $this->causesTableGateway = $causesTableGateway;
    }

    public function getNewTableGatewayInstance() : TableGateways\CausesTableGateway
    {
        return $this->causesTableGateway;
    }
    
    public function getNewModelInstance($dataExchange = []) : Models\CausesModel
    {
        return $this->causesTableGateway->getNewModelInstance($dataExchange);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @param array|null $wheres
     * @param string|null $order
     * @param string|null $orderDirection
     * @return Models\CausesModel[]
     */
    public function getAll(
        int $limit = null,
        int $offset = null,
        array $wheres = null,
        string $order = null,
        string $orderDirection = null
    )
    {

        $causesTable = $this->getNewTableGatewayInstance();
        list($allCausess, $count) = $causesTable->fetchAll(
            $limit,
            $offset,
            $wheres,
            $order,
            $orderDirection !== null ? $orderDirection : Select::ORDER_ASCENDING
        );
        $return = [];

        if ($allCausess instanceof ResultSet) {
            foreach ($allCausess as $causes) {
                $return[] = $causes;
            }
        }
        return $return;
    }

    /**
     * @param int $id
     * @return Models\CausesModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getById(int $id) : Models\CausesModel
    {
        /** @var TableGateways\CausesTableGateway $causesTable */
        $causesTable = $this->getNewTableGatewayInstance();
        return $causesTable->getById($id);
    }

    /**
     * @param string $field
     * @param $value
     * @param $orderBy string Field to sort by
     * @param $orderDirection string Direction to sort (Select::ORDER_ASCENDING || Select::ORDER_DESCENDING)
     * @return Models\CausesModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getByField(string $field, $value, $orderBy = null, $orderDirection = Select::ORDER_ASCENDING) : Models\CausesModel
    {
        /** @var TableGateways\CausesTableGateway $causesTable */
        $causesTable = $this->getNewTableGatewayInstance();
        return $causesTable->getByField($field, $value, $orderBy, $orderDirection);
    }

    /**
     * @param string $field
     * @param $value
     * @param $orderBy string Field to sort by
     * @param $orderDirection string Direction to sort (Select::ORDER_ASCENDING || Select::ORDER_DESCENDING)
     * @return Models\CausesModel[]
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getManyByField(string $field, $value, $orderBy = null, $orderDirection = Select::ORDER_ASCENDING) : array
    {
        /** @var TableGateways\CausesTableGateway $causesTable */
        $causesTable = $this->getNewTableGatewayInstance();
        return $causesTable->getManyByField($field, $value, $orderBy, $orderDirection);
    }

    /**
     * @return Models\CausesModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getRandom() : Models\CausesModel
    {
        /** @var TableGateways\CausesTableGateway $causesTable */
        $causesTable = $this->getNewTableGatewayInstance();
        return $causesTable->fetchRandom();
    }

    /**
     * @param $dataExchange
     * @return array|\ArrayObject|null
     */
    public function createFromArray($dataExchange)
    {
        /** @var TableGateways\CausesTableGateway $causesTable */
        $causesTable = $this->getNewTableGatewayInstance();
        $causes = $this->getNewModelInstance($dataExchange);
        return $causesTable->save($causes);
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteByID($id) : int
    {
        /** @var TableGateways\CausesTableGateway $causesTable */
        $causesTable = $this->getNewTableGatewayInstance();
        return $causesTable->delete(['id' => $id]);
    }

    public function getTermPlural() : string
    {
        return 'Causes';
    }

    public function getTermSingular() : string
    {
        return 'Causes';
    }

    /**
     * @returns Models\CausesModel
     */
    public function getMockObject()
    {
        return $this->getNewTableGatewayInstance()->getNewMockModelInstance();
    }
}
