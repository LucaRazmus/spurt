<?php
namespace Spurt\Models\Base;
use \Spurt\Spurt as App;
use \Spurt\Spurt;
use \Segura\AppCore\Abstracts\Model as AbstractModel;
use Segura\AppCore\Interfaces\ModelInterface as ModelInterface;
use \Spurt\Services;
use \Spurt\Models;
use \Spurt\TableGateways;
use \Spurt\Models\OrgasmsModel;

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
abstract class BaseOrgasmsModel
    extends AbstractModel
    implements ModelInterface
{

    // Declare what fields are available on this object
    const FIELD_ID = 'id';
    const FIELD_USER_ID = 'user_id';
    const FIELD_DATETIME = 'datetime';

    protected $_primary_keys = ['id'];

    protected $_autoincrement_keys = ['id'];

    protected $id;
    protected $user_id;
    protected $datetime;

    /**
     * @returns OrgasmsModel
     */
    static public function factory()
    {
        return parent::factory();
    }

    /**
     * @returns int
     */
    public function getId()     {
        return $this->id;
    }

    /**
     * @returns OrgasmsModel
     */
    public function setId(int $id = null)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @returns int
     */
    public function getUser_id()     {
        return $this->user_id;
    }

    /**
     * @returns OrgasmsModel
     */
    public function setUser_id(int $user_id = null)
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @returns string
     */
    public function getDatetime()     {
        return $this->datetime;
    }

    /**
     * @returns OrgasmsModel
     */
    public function setDatetime(string $datetime = null)
    {
        $this->datetime = $datetime;
        return $this;
    }


    /*****************************************************
     * "Referenced To" Remote Constraint Object Fetchers *
     *****************************************************/
    /**
     * @returns Models\UsersModel
     */
    public function fetchUserObject() : Models\UsersModel
    {
        /** @var $UsersService Services\UsersService */
        $UsersService = App::Container()->get(Services\UsersService::class);
        return $UsersService->getById($this->getUser_id());
    }


    /*****************************************************
     * "Referenced By" Remote Constraint Object Fetchers *
     *****************************************************/
    /**
     * @returns Models\CauseOrgasmLinkModel
     */
    public function fetchCauseOrgasmLinkObject(
        $orderBy = null,
        $orderDirection='ASC'
    ) : Models\CauseOrgasmLinkModel {
        /** @var $causeOrgasmLinkService Services\CauseOrgasmLinkService */
        $causeOrgasmLinkService = App::Container()->get(Services\CauseOrgasmLinkService::class);
        return $causeOrgasmLinkService->getByField('orgasm_id', $this->getId(), $orderBy, $orderDirection);
    }

    /**
     * @returns Models\CauseOrgasmLinkModel[]
     */
    public function fetchCauseOrgasmLinkObjects(
        $orderBy = null,
        $orderDirection='ASC'
    ) : array {
        /** @var $causeOrgasmLinkService Services\CauseOrgasmLinkService */
        $causeOrgasmLinkService = App::Container()->get(Services\CauseOrgasmLinkService::class);
        return $causeOrgasmLinkService->getManyByField('orgasm_id', $this->getId(), $orderBy, $orderDirection);
    }


    /**
     * @returns OrgasmsModel
     */
    public function save()
    {
        /** @var $tableGateway TableGateways\OrgasmsTableGateway */
        $tableGateway = App::Container()->get(TableGateways\OrgasmsTableGateway::class);
        return $tableGateway->save($this);
    }

    /**
     * Destroy the current record.
     *
     * @return int Number of affected rows.
     */
    public function destroy()
    {
        /** @var $tableGateway TableGateways\OrgasmsTableGateway */
        $tableGateway = App::Container()->get(TableGateways\OrgasmsTableGateway::class);
        return $tableGateway->delete($this->getPrimaryKeys());
    }

    /**
     * Provides an array of all properties in this model.
     * @returns array
     */
    public function getListOfProperties()
    {
        return [
            'id',
            'user_id',
            'datetime',
        ];
    }
}