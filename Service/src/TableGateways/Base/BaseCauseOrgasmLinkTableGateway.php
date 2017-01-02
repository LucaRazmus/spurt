<?php
namespace Spurt\TableGateways\Base;
use \Segura\AppCore\Abstracts\TableGateway as AbstractTableGateway;
use \Segura\AppCore\Abstracts\Model;
use \Segura\AppCore\Db;
use \Spurt\TableGateways;
use \Spurt\Models;
use \Zend\Db\Adapter\AdapterInterface;
use \Zend\Db\ResultSet\ResultSet;

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
// @todo: Make all TableGateways implement a TableGatewayInterface. -MB
abstract class BaseCauseOrgasmLinkTableGateway extends AbstractTableGateway
{
    protected $table = 'causeOrgasmLink';

    protected $database = 'Default';

    protected $model = 'Spurt\Models\CauseOrgasmLinkModel';

    /** @var \Faker\Generator */
    protected $faker;

    /** @var Db */
    private $databaseConnector;

    private $databaseAdaptor;

    /** @var TableGateways\CausesTableGateway */
    protected $causesTableGateway;
    /** @var TableGateways\OrgasmsTableGateway */
    protected $orgasmsTableGateway;

    /**
     * AbstractTableGateway constructor.
     *
     * @param TableGateways\CausesTableGateway $causesTableGateway,
     * @param TableGateways\OrgasmsTableGateway $orgasmsTableGateway,
     * @param Db $databaseConnector
     */
    public function __construct(
        TableGateways\CausesTableGateway $causesTableGateway,
        TableGateways\OrgasmsTableGateway $orgasmsTableGateway,
        \Faker\Generator $faker,
        Db $databaseConnector
    )
    {
        $this->causesTableGateway = $causesTableGateway;
        $this->orgasmsTableGateway = $orgasmsTableGateway;
        $this->faker = $faker;
        $this->databaseConnector = $databaseConnector;

        /** @var $adaptor AdapterInterface */
        // @todo rename all uses of 'adaptor' to 'adapter'. I cannot spell - MB
        $this->databaseAdaptor = $this->databaseConnector->getDatabase($this->database);
        $resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAYOBJECT, new $this->model);
        return parent::__construct($this->table, $this->databaseAdaptor, null, $resultSetPrototype);
    }

    /**
     * @return Models\CauseOrgasmLinkModel
     */
    public function getNewMockModelInstance()
    {

      $newCauseOrgasmLinkData = [
        // cause_id. Type = int. PHPType = int. Has related objects.
        'cause_id' =>
            $this->causesTableGateway->fetchRandom() instanceof Models\CausesModel
            ? $this->causesTableGateway->fetchRandom()->getId()
            : $this->causesTableGateway->getNewMockModelInstance()->save()->getId(),

        // id. Type = int. PHPType = int. Has no related objects.
        'id' => null,
        // orgasm_id. Type = int. PHPType = int. Has related objects.
        'orgasm_id' =>
            $this->orgasmsTableGateway->fetchRandom() instanceof Models\OrgasmsModel
            ? $this->orgasmsTableGateway->fetchRandom()->getId()
            : $this->orgasmsTableGateway->getNewMockModelInstance()->save()->getId(),

      ];
      $newCauseOrgasmLink = $this->getNewModelInstance($newCauseOrgasmLinkData);
      return $newCauseOrgasmLink;
    }

    /**
     * @param array $data
     * @return Models\CauseOrgasmLinkModel
     */
    public function getNewModelInstance(array $data = [])
    {
        return parent::getNewModelInstance($data);
    }

    /**
     * @param Models\CauseOrgasmLinkModel $model
     * @return Models\CauseOrgasmLinkModel
     */
    public function save(Model $model)
    {
        return parent::save($model);
    }
}