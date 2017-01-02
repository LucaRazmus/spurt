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
abstract class BaseCauseOrgasmLinkService
    extends AbstractService
    implements ServiceInterface
{

    // Related Objects Table Gateways
    /** @var TableGateways\CausesTableGateway */
    protected $causesTableGateway;
    /** @var TableGateways\OrgasmsTableGateway */
    protected $orgasmsTableGateway;

    // Remote Constraints Table Gateways

    // Self Table Gateway
    /** @var TableGateways\CauseOrgasmLinkTableGateway */
    protected $causeOrgasmLinkTableGateway;

    /**
     * Constructor.
     *
     * @param TableGateways\CausesTableGateway $causesTableGateway
     * @param TableGateways\OrgasmsTableGateway $orgasmsTableGateway
     * @param TableGateways\CauseOrgasmLinkTableGateway $causeOrgasmLinkTableGateway
     */
    public function __construct(
        TableGateways\CausesTableGateway $causesTableGateway,
        TableGateways\OrgasmsTableGateway $orgasmsTableGateway,
        TableGateways\CauseOrgasmLinkTableGateway $causeOrgasmLinkTableGateway
    )
    {
        $this->causesTableGateway = $causesTableGateway;
        $this->orgasmsTableGateway = $orgasmsTableGateway;
        $this->causeOrgasmLinkTableGateway = $causeOrgasmLinkTableGateway;
    }

    public function getNewTableGatewayInstance() : TableGateways\CauseOrgasmLinkTableGateway
    {
        return $this->causeOrgasmLinkTableGateway;
    }
    
    public function getNewModelInstance($dataExchange = []) : Models\CauseOrgasmLinkModel
    {
        return $this->causeOrgasmLinkTableGateway->getNewModelInstance($dataExchange);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @param array|null $wheres
     * @param string|null $order
     * @param string|null $orderDirection
     * @return Models\CauseOrgasmLinkModel[]
     */
    public function getAll(
        int $limit = null,
        int $offset = null,
        array $wheres = null,
        string $order = null,
        string $orderDirection = null
    )
    {

        $causeOrgasmLinkTable = $this->getNewTableGatewayInstance();
        list($allCauseOrgasmLinks, $count) = $causeOrgasmLinkTable->fetchAll(
            $limit,
            $offset,
            $wheres,
            $order,
            $orderDirection !== null ? $orderDirection : Select::ORDER_ASCENDING
        );
        $return = [];

        if ($allCauseOrgasmLinks instanceof ResultSet) {
            foreach ($allCauseOrgasmLinks as $causeOrgasmLink) {
                $return[] = $causeOrgasmLink;
            }
        }
        return $return;
    }

    /**
     * @param int $id
     * @return Models\CauseOrgasmLinkModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getById(int $id) : Models\CauseOrgasmLinkModel
    {
        /** @var TableGateways\CauseOrgasmLinkTableGateway $causeOrgasmLinkTable */
        $causeOrgasmLinkTable = $this->getNewTableGatewayInstance();
        return $causeOrgasmLinkTable->getById($id);
    }

    /**
     * @param string $field
     * @param $value
     * @param $orderBy string Field to sort by
     * @param $orderDirection string Direction to sort (Select::ORDER_ASCENDING || Select::ORDER_DESCENDING)
     * @return Models\CauseOrgasmLinkModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getByField(string $field, $value, $orderBy = null, $orderDirection = Select::ORDER_ASCENDING) : Models\CauseOrgasmLinkModel
    {
        /** @var TableGateways\CauseOrgasmLinkTableGateway $causeOrgasmLinkTable */
        $causeOrgasmLinkTable = $this->getNewTableGatewayInstance();
        return $causeOrgasmLinkTable->getByField($field, $value, $orderBy, $orderDirection);
    }

    /**
     * @param string $field
     * @param $value
     * @param $orderBy string Field to sort by
     * @param $orderDirection string Direction to sort (Select::ORDER_ASCENDING || Select::ORDER_DESCENDING)
     * @return Models\CauseOrgasmLinkModel[]
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getManyByField(string $field, $value, $orderBy = null, $orderDirection = Select::ORDER_ASCENDING) : array
    {
        /** @var TableGateways\CauseOrgasmLinkTableGateway $causeOrgasmLinkTable */
        $causeOrgasmLinkTable = $this->getNewTableGatewayInstance();
        return $causeOrgasmLinkTable->getManyByField($field, $value, $orderBy, $orderDirection);
    }

    /**
     * @return Models\CauseOrgasmLinkModel
     * @throws \Segura\AppCore\Exceptions\TableGatewayException
     */
    public function getRandom() : Models\CauseOrgasmLinkModel
    {
        /** @var TableGateways\CauseOrgasmLinkTableGateway $causeOrgasmLinkTable */
        $causeOrgasmLinkTable = $this->getNewTableGatewayInstance();
        return $causeOrgasmLinkTable->fetchRandom();
    }

    /**
     * @param $dataExchange
     * @return array|\ArrayObject|null
     */
    public function createFromArray($dataExchange)
    {
        /** @var TableGateways\CauseOrgasmLinkTableGateway $causeOrgasmLinkTable */
        $causeOrgasmLinkTable = $this->getNewTableGatewayInstance();
        $causeOrgasmLink = $this->getNewModelInstance($dataExchange);
        return $causeOrgasmLinkTable->save($causeOrgasmLink);
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteByID($id) : int
    {
        /** @var TableGateways\CauseOrgasmLinkTableGateway $causeOrgasmLinkTable */
        $causeOrgasmLinkTable = $this->getNewTableGatewayInstance();
        return $causeOrgasmLinkTable->delete(['id' => $id]);
    }

    public function getTermPlural() : string
    {
        return 'CauseOrgasmLinks';
    }

    public function getTermSingular() : string
    {
        return 'CauseOrgasmLink';
    }

    /**
     * @returns Models\CauseOrgasmLinkModel
     */
    public function getMockObject()
    {
        return $this->getNewTableGatewayInstance()->getNewMockModelInstance();
    }
}
