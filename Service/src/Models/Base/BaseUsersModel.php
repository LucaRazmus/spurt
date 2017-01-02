<?php
namespace Spurt\Models\Base;
use \Spurt\Spurt as App;
use \Spurt\Spurt;
use \Segura\AppCore\Abstracts\Model as AbstractModel;
use Segura\AppCore\Interfaces\ModelInterface as ModelInterface;
use \Spurt\Services;
use \Spurt\Models;
use \Spurt\TableGateways;
use \Spurt\Models\UsersModel;

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
abstract class BaseUsersModel
    extends AbstractModel
    implements ModelInterface
{

    // Declare what fields are available on this object
    const FIELD_ID = 'id';
    const FIELD_USERNAME = 'username';
    const FIELD_EMAIL = 'email';
    const FIELD_PASSWORD = 'password';
    const FIELD_DATAISPRIVATE = 'dataIsPrivate';
    const FIELD_CREATEDDATE = 'createdDate';
    const FIELD_LASTUPDATEDDATE = 'lastUpdatedDate';

    protected $_primary_keys = ['id'];

    protected $_autoincrement_keys = ['id'];

    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $dataIsPrivate;
    protected $createdDate;
    protected $lastUpdatedDate;

    /**
     * @returns UsersModel
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
     * @returns UsersModel
     */
    public function setId(int $id = null)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @returns string
     */
    public function getUsername()     {
        return $this->username;
    }

    /**
     * @returns UsersModel
     */
    public function setUsername(string $username = null)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @returns string
     */
    public function getEmail()     {
        return $this->email;
    }

    /**
     * @returns UsersModel
     */
    public function setEmail(string $email = null)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @returns string
     */
    public function getPassword()     {
        return $this->password;
    }

    /**
     * @returns UsersModel
     */
    public function setPassword(string $password = null)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @returns string
     */
    public function getDataIsPrivate()     {
        return $this->dataIsPrivate;
    }

    /**
     * @returns UsersModel
     */
    public function setDataIsPrivate(string $dataIsPrivate = null)
    {
        $this->dataIsPrivate = $dataIsPrivate;
        return $this;
    }

    /**
     * @returns string
     */
    public function getCreatedDate()     {
        return $this->createdDate;
    }

    /**
     * @returns UsersModel
     */
    public function setCreatedDate(string $createdDate = null)
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @returns string
     */
    public function getLastUpdatedDate()     {
        return $this->lastUpdatedDate;
    }

    /**
     * @returns UsersModel
     */
    public function setLastUpdatedDate(string $lastUpdatedDate = null)
    {
        $this->lastUpdatedDate = $lastUpdatedDate;
        return $this;
    }


    /*****************************************************
     * "Referenced To" Remote Constraint Object Fetchers *
     *****************************************************/

    /*****************************************************
     * "Referenced By" Remote Constraint Object Fetchers *
     *****************************************************/
    /**
     * @returns Models\OrgasmsModel
     */
    public function fetchOrgasmObject(
        $orderBy = null,
        $orderDirection='ASC'
    ) : Models\OrgasmsModel {
        /** @var $orgasmsService Services\OrgasmsService */
        $orgasmsService = App::Container()->get(Services\OrgasmsService::class);
        return $orgasmsService->getByField('user_id', $this->getId(), $orderBy, $orderDirection);
    }

    /**
     * @returns Models\OrgasmsModel[]
     */
    public function fetchOrgasmObjects(
        $orderBy = null,
        $orderDirection='ASC'
    ) : array {
        /** @var $orgasmsService Services\OrgasmsService */
        $orgasmsService = App::Container()->get(Services\OrgasmsService::class);
        return $orgasmsService->getManyByField('user_id', $this->getId(), $orderBy, $orderDirection);
    }


    /**
     * @returns UsersModel
     */
    public function save()
    {
        /** @var $tableGateway TableGateways\UsersTableGateway */
        $tableGateway = App::Container()->get(TableGateways\UsersTableGateway::class);
        return $tableGateway->save($this);
    }

    /**
     * Destroy the current record.
     *
     * @return int Number of affected rows.
     */
    public function destroy()
    {
        /** @var $tableGateway TableGateways\UsersTableGateway */
        $tableGateway = App::Container()->get(TableGateways\UsersTableGateway::class);
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
            'username',
            'email',
            'password',
            'dataIsPrivate',
            'createdDate',
            'lastUpdatedDate',
        ];
    }
}