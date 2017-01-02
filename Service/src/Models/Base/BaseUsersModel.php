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

    protected $_primary_keys = ['id'];

    protected $_autoincrement_keys = ['id'];

    protected $id;
    protected $uuid;
    protected $username;
    protected $email;
    protected $password;
    protected $dateCreated;
    protected $dateLastSeen;
    protected $state;

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
    public function getUuid()     {
        return $this->uuid;
    }

    /**
     * @returns UsersModel
     */
    public function setUuid(string $uuid = null)
    {
        $this->uuid = $uuid;
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
    public function getDateCreated()     {
        return $this->dateCreated;
    }

    /**
     * @returns UsersModel
     */
    public function setDateCreated(string $dateCreated = null)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @returns string
     */
    public function getDateLastSeen()     {
        return $this->dateLastSeen;
    }

    /**
     * @returns UsersModel
     */
    public function setDateLastSeen(string $dateLastSeen = null)
    {
        $this->dateLastSeen = $dateLastSeen;
        return $this;
    }

    /**
     * @returns string
     */
    public function getState()     {
        return $this->state;
    }

    /**
     * @returns UsersModel
     */
    public function setState(string $state = null)
    {
        $this->state = $state;
        return $this;
    }


    /*****************************************************
     * "Referenced To" Remote Constraint Object Fetchers *
     *****************************************************/

    /*****************************************************
     * "Referenced By" Remote Constraint Object Fetchers *
     *****************************************************/
    /**
     * @returns Models\CharactersModel
     */
    public function fetchCharacterObject() : Models\CharactersModel {
        /** @var $charactersService Services\CharactersService */
        $charactersService = App::Container()->get(Services\CharactersService::class);
        return $charactersService->getByField('userId', $this->getId());
    }

    /**
     * @returns Models\CharactersModel[]
     */
    public function fetchCharacterObjects() : array {
        /** @var $charactersService Services\CharactersService */
        $charactersService = App::Container()->get(Services\CharactersService::class);
        return $charactersService->getManyByField('userId', $this->getId());
    }

    /**
     * @returns Models\SessionsModel
     */
    public function fetchSessionObject() : Models\SessionsModel {
        /** @var $sessionsService Services\SessionsService */
        $sessionsService = App::Container()->get(Services\SessionsService::class);
        return $sessionsService->getByField('userId', $this->getId());
    }

    /**
     * @returns Models\SessionsModel[]
     */
    public function fetchSessionObjects() : array {
        /** @var $sessionsService Services\SessionsService */
        $sessionsService = App::Container()->get(Services\SessionsService::class);
        return $sessionsService->getManyByField('userId', $this->getId());
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
            'uuid',
            'username',
            'email',
            'password',
            'dateCreated',
            'dateLastSeen',
            'state',
        ];
    }
}