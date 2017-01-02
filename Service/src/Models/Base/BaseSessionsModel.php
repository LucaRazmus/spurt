<?php
namespace Spurt\Models\Base;
use \Spurt\Spurt as App;
use \Spurt\Spurt;
use \Segura\AppCore\Abstracts\Model as AbstractModel;
use Segura\AppCore\Interfaces\ModelInterface as ModelInterface;
use \Spurt\Services;
use \Spurt\Models;
use \Spurt\TableGateways;
use \Spurt\Models\SessionsModel;

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
abstract class BaseSessionsModel
    extends AbstractModel
    implements ModelInterface
{

    protected $_primary_keys = ['id'];

    protected $_autoincrement_keys = ['id'];

    protected $id;
    protected $uuid;
    protected $userId;
    protected $key;
    protected $created;
    protected $expires;

    /**
     * @returns SessionsModel
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
     * @returns SessionsModel
     */
    public function setId(int $id = null)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @returns string
     */
    public function getUuid()     {
        return $this->uuid;
    }

    /**
     * @returns SessionsModel
     */
    public function setUuid(string $uuid = null)
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @returns int
     */
    public function getUserId()     {
        return $this->userId;
    }

    /**
     * @returns SessionsModel
     */
    public function setUserId(int $userId = null)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @returns string
     */
    public function getKey()     {
        return $this->key;
    }

    /**
     * @returns SessionsModel
     */
    public function setKey(string $key = null)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @returns string
     */
    public function getCreated()     {
        return $this->created;
    }

    /**
     * @returns SessionsModel
     */
    public function setCreated(string $created = null)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @returns string
     */
    public function getExpires()     {
        return $this->expires;
    }

    /**
     * @returns SessionsModel
     */
    public function setExpires(string $expires = null)
    {
        $this->expires = $expires;
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
        return $UsersService->getById($this->getUserId());
    }



    /**
     * @returns SessionsModel
     */
    public function save()
    {
        /** @var $tableGateway TableGateways\SessionsTableGateway */
        $tableGateway = App::Container()->get(TableGateways\SessionsTableGateway::class);
        return $tableGateway->save($this);
    }

    /**
     * Destroy the current record.
     *
     * @return int Number of affected rows.
     */
    public function destroy()
    {
        /** @var $tableGateway TableGateways\SessionsTableGateway */
        $tableGateway = App::Container()->get(TableGateways\SessionsTableGateway::class);
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
            'uuid',
            'userId',
            'key',
            'created',
            'expires',
        ];
    }
}