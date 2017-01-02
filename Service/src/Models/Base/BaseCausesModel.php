<?php
namespace Spurt\Models\Base;
use \Spurt\Spurt as App;
use \Spurt\Spurt;
use \Segura\AppCore\Abstracts\Model as AbstractModel;
use Segura\AppCore\Interfaces\ModelInterface as ModelInterface;
use \Spurt\Services;
use \Spurt\Models;
use \Spurt\TableGateways;
use \Spurt\Models\CausesModel;

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
abstract class BaseCausesModel
    extends AbstractModel
    implements ModelInterface
{

    // Declare what fields are available on this object
    const FIELD_ID = 'id';
    const FIELD_NAME = 'name';

    protected $_primary_keys = ['id'];

    protected $_autoincrement_keys = ['id'];

    protected $id;
    protected $name;

    /**
     * @returns CausesModel
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
     * @returns CausesModel
     */
    public function setId(int $id = null)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @returns string
     */
    public function getName()     {
        return $this->name;
    }

    /**
     * @returns CausesModel
     */
    public function setName(string $name = null)
    {
        $this->name = $name;
        return $this;
    }


    /*****************************************************
     * "Referenced To" Remote Constraint Object Fetchers *
     *****************************************************/

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
        return $causeOrgasmLinkService->getByField('cause_id', $this->getId(), $orderBy, $orderDirection);
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
        return $causeOrgasmLinkService->getManyByField('cause_id', $this->getId(), $orderBy, $orderDirection);
    }


    /**
     * @returns CausesModel
     */
    public function save()
    {
        /** @var $tableGateway TableGateways\CausesTableGateway */
        $tableGateway = App::Container()->get(TableGateways\CausesTableGateway::class);
        return $tableGateway->save($this);
    }

    /**
     * Destroy the current record.
     *
     * @return int Number of affected rows.
     */
    public function destroy()
    {
        /** @var $tableGateway TableGateways\CausesTableGateway */
        $tableGateway = App::Container()->get(TableGateways\CausesTableGateway::class);
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
            'name',
        ];
    }
}