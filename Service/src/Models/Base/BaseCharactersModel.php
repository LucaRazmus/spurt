<?php
namespace Spurt\Models\Base;
use \Spurt\Spurt as App;
use \Spurt\Spurt;
use \Segura\AppCore\Abstracts\Model as AbstractModel;
use Segura\AppCore\Interfaces\ModelInterface as ModelInterface;
use \Spurt\Services;
use \Spurt\Models;
use \Spurt\TableGateways;
use \Spurt\Models\CharactersModel;

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
abstract class BaseCharactersModel
    extends AbstractModel
    implements ModelInterface
{

    protected $_primary_keys = ['id'];

    protected $_autoincrement_keys = ['id'];

    protected $id;
    protected $uuid;
    protected $userId;
    protected $name;
    protected $description;
    protected $dateCreated;
    protected $dateLastSeen;

    /**
     * @returns CharactersModel
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
     * @returns CharactersModel
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
     * @returns CharactersModel
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
     * @returns CharactersModel
     */
    public function setUserId(int $userId = null)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @returns string
     */
    public function getName()     {
        return $this->name;
    }

    /**
     * @returns CharactersModel
     */
    public function setName(string $name = null)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @returns string
     */
    public function getDescription()     {
        return $this->description;
    }

    /**
     * @returns CharactersModel
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @returns string
     */
    public function getDateCreated()     {
        return $this->dateCreated;
    }

    /**
     * @returns CharactersModel
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
     * @returns CharactersModel
     */
    public function setDateLastSeen(string $dateLastSeen = null)
    {
        $this->dateLastSeen = $dateLastSeen;
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


    /*****************************************************
     * "Referenced By" Remote Constraint Object Fetchers *
     *****************************************************/
    /**
     * @returns Models\MessagesModel
     */
    public function fetchMessageByCharacterFromIdObject() : Models\MessagesModel {
        /** @var $messagesService Services\MessagesService */
        $messagesService = App::Container()->get(Services\MessagesService::class);
        return $messagesService->getByField('characterFromId', $this->getId());
    }

    /**
     * @returns Models\MessagesModel[]
     */
    public function fetchMessageByCharacterFromIdObjects() : array {
        /** @var $messagesService Services\MessagesService */
        $messagesService = App::Container()->get(Services\MessagesService::class);
        return $messagesService->getManyByField('characterFromId', $this->getId());
    }

    /**
     * @returns Models\MessagesModel
     */
    public function fetchMessageByCharacterToIdObject() : Models\MessagesModel {
        /** @var $messagesService Services\MessagesService */
        $messagesService = App::Container()->get(Services\MessagesService::class);
        return $messagesService->getByField('characterToId', $this->getId());
    }

    /**
     * @returns Models\MessagesModel[]
     */
    public function fetchMessageByCharacterToIdObjects() : array {
        /** @var $messagesService Services\MessagesService */
        $messagesService = App::Container()->get(Services\MessagesService::class);
        return $messagesService->getManyByField('characterToId', $this->getId());
    }


    /**
     * @returns CharactersModel
     */
    public function save()
    {
        /** @var $tableGateway TableGateways\CharactersTableGateway */
        $tableGateway = App::Container()->get(TableGateways\CharactersTableGateway::class);
        return $tableGateway->save($this);
    }

    /**
     * Destroy the current record.
     *
     * @return int Number of affected rows.
     */
    public function destroy()
    {
        /** @var $tableGateway TableGateways\CharactersTableGateway */
        $tableGateway = App::Container()->get(TableGateways\CharactersTableGateway::class);
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
            'name',
            'description',
            'dateCreated',
            'dateLastSeen',
        ];
    }
}