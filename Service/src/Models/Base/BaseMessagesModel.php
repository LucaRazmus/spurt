<?php
namespace Spurt\Models\Base;
use \Spurt\Spurt as App;
use \Spurt\Spurt;
use \Segura\AppCore\Abstracts\Model as AbstractModel;
use Segura\AppCore\Interfaces\ModelInterface as ModelInterface;
use \Spurt\Services;
use \Spurt\Models;
use \Spurt\TableGateways;
use \Spurt\Models\MessagesModel;

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
abstract class BaseMessagesModel
    extends AbstractModel
    implements ModelInterface
{

    protected $_primary_keys = ['id'];

    protected $_autoincrement_keys = ['id'];

    protected $id;
    protected $uuid;
    protected $characterFromId;
    protected $characterToId;
    protected $message;
    protected $dateCreated;
    protected $dateRead;

    /**
     * @returns MessagesModel
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
     * @returns MessagesModel
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
     * @returns MessagesModel
     */
    public function setUuid(string $uuid = null)
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @returns int
     */
    public function getCharacterFromId()     {
        return $this->characterFromId;
    }

    /**
     * @returns MessagesModel
     */
    public function setCharacterFromId(int $characterFromId = null)
    {
        $this->characterFromId = $characterFromId;
        return $this;
    }

    /**
     * @returns int
     */
    public function getCharacterToId()     {
        return $this->characterToId;
    }

    /**
     * @returns MessagesModel
     */
    public function setCharacterToId(int $characterToId = null)
    {
        $this->characterToId = $characterToId;
        return $this;
    }

    /**
     * @returns string
     */
    public function getMessage()     {
        return $this->message;
    }

    /**
     * @returns MessagesModel
     */
    public function setMessage(string $message = null)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @returns string
     */
    public function getDateCreated()     {
        return $this->dateCreated;
    }

    /**
     * @returns MessagesModel
     */
    public function setDateCreated(string $dateCreated = null)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @returns string
     */
    public function getDateRead()     {
        return $this->dateRead;
    }

    /**
     * @returns MessagesModel
     */
    public function setDateRead(string $dateRead = null)
    {
        $this->dateRead = $dateRead;
        return $this;
    }


    /*****************************************************
     * "Referenced To" Remote Constraint Object Fetchers *
     *****************************************************/
    /**
     * @returns Models\CharactersModel
     */
    public function fetchCharacterByCharacterFromIdObject() : Models\CharactersModel
    {
        /** @var $CharactersService Services\CharactersService */
        $CharactersService = App::Container()->get(Services\CharactersService::class);
        return $CharactersService->getById($this->getCharacterFromId());
    }

    /**
     * @returns Models\CharactersModel
     */
    public function fetchCharacterByCharacterToIdObject() : Models\CharactersModel
    {
        /** @var $CharactersService Services\CharactersService */
        $CharactersService = App::Container()->get(Services\CharactersService::class);
        return $CharactersService->getById($this->getCharacterToId());
    }



    /**
     * @returns MessagesModel
     */
    public function save()
    {
        /** @var $tableGateway TableGateways\MessagesTableGateway */
        $tableGateway = App::Container()->get(TableGateways\MessagesTableGateway::class);
        return $tableGateway->save($this);
    }

    /**
     * Destroy the current record.
     *
     * @return int Number of affected rows.
     */
    public function destroy()
    {
        /** @var $tableGateway TableGateways\MessagesTableGateway */
        $tableGateway = App::Container()->get(TableGateways\MessagesTableGateway::class);
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
            'characterFromId',
            'characterToId',
            'message',
            'dateCreated',
            'dateRead',
        ];
    }
}