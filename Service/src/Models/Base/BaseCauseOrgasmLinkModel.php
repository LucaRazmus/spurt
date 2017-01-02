<?php
namespace Spurt\Models\Base;
use \Spurt\Spurt as App;
use \Spurt\Spurt;
use \Segura\AppCore\Abstracts\Model as AbstractModel;
use Segura\AppCore\Interfaces\ModelInterface as ModelInterface;
use \Spurt\Services;
use \Spurt\Models;
use \Spurt\TableGateways;
use \Spurt\Models\CauseOrgasmLinkModel;

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
abstract class BaseCauseOrgasmLinkModel
    extends AbstractModel
    implements ModelInterface
{

    // Declare what fields are available on this object
    const FIELD_ID = 'id';
    const FIELD_CAUSE_ID = 'cause_id';
    const FIELD_ORGASM_ID = 'orgasm_id';

    protected $_primary_keys = ['id'];

    protected $_autoincrement_keys = ['id'];

    protected $id;
    protected $cause_id;
    protected $orgasm_id;

    /**
     * @returns CauseOrgasmLinkModel
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
     * @returns CauseOrgasmLinkModel
     */
    public function setId(int $id = null)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @returns int
     */
    public function getCause_id()     {
        return $this->cause_id;
    }

    /**
     * @returns CauseOrgasmLinkModel
     */
    public function setCause_id(int $cause_id = null)
    {
        $this->cause_id = $cause_id;
        return $this;
    }

    /**
     * @returns int
     */
    public function getOrgasm_id()     {
        return $this->orgasm_id;
    }

    /**
     * @returns CauseOrgasmLinkModel
     */
    public function setOrgasm_id(int $orgasm_id = null)
    {
        $this->orgasm_id = $orgasm_id;
        return $this;
    }


    /*****************************************************
     * "Referenced To" Remote Constraint Object Fetchers *
     *****************************************************/
    /**
     * @returns Models\CausesModel
     */
    public function fetchCausObject() : Models\CausesModel
    {
        /** @var $CausesService Services\CausesService */
        $CausesService = App::Container()->get(Services\CausesService::class);
        return $CausesService->getById($this->getCause_id());
    }

    /**
     * @returns Models\OrgasmsModel
     */
    public function fetchOrgasmObject() : Models\OrgasmsModel
    {
        /** @var $OrgasmsService Services\OrgasmsService */
        $OrgasmsService = App::Container()->get(Services\OrgasmsService::class);
        return $OrgasmsService->getById($this->getOrgasm_id());
    }



    /**
     * @returns CauseOrgasmLinkModel
     */
    public function save()
    {
        /** @var $tableGateway TableGateways\CauseOrgasmLinkTableGateway */
        $tableGateway = App::Container()->get(TableGateways\CauseOrgasmLinkTableGateway::class);
        return $tableGateway->save($this);
    }

    /**
     * Destroy the current record.
     *
     * @return int Number of affected rows.
     */
    public function destroy()
    {
        /** @var $tableGateway TableGateways\CauseOrgasmLinkTableGateway */
        $tableGateway = App::Container()->get(TableGateways\CauseOrgasmLinkTableGateway::class);
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
            'cause_id',
            'orgasm_id',
        ];
    }
}