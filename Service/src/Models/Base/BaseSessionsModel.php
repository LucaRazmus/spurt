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

    // Declare what fields are available on this object
    const FIELD_ID = 'id';
    const FIELD_USER_ID = 'user_id';
    const FIELD_START = 'start';
    const FIELD_END = 'end';

    protected $_primary_keys = ['id'];

    protected $_autoincrement_keys = ['id'];

    protected $id;
    protected $user_id;
    protected $start;
    protected $end;

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
     * @returns int
     */
    public function getUser_id()     {
        return $this->user_id;
    }

    /**
     * @returns SessionsModel
     */
    public function setUser_id(int $user_id = null)
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @returns string
     */
    public function getStart()     {
        return $this->start;
    }

    /**
     * @returns SessionsModel
     */
    public function setStart(string $start = null)
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @returns string
     */
    public function getEnd()     {
        return $this->end;
    }

    /**
     * @returns SessionsModel
     */
    public function setEnd(string $end = null)
    {
        $this->end = $end;
        return $this;
    }


    /*****************************************************
     * "Referenced To" Remote Constraint Object Fetchers *
     *****************************************************/


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
            'user_id',
            'start',
            'end',
        ];
    }
}