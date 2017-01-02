<?php
namespace Spurt\Services;

use Spurt\Services\Base\BaseSessionsService;
use Segura\AppCore\Exceptions\TableGatewayRecordNotFoundException;

class SessionsService extends BaseSessionsService
{
    /**
     * @param string $sessionKey
     * @return false|\Spurt\Models\UsersModel
     */
    public function validateSession(string $sessionKey){
        try {
            $session = $this->getByField('key', $sessionKey);
            if(strtotime($session->getExpires()) < time()){
                return false;
            }else{
                if($session->getExpires() < strtotime("5 minutes from now")) {
                    $session
                        ->setExpires(date("Y-m-d H:i:s", strtotime("5 minutes from now")))
                        ->save();
                }
                return $session->fetchUserObject();
            }
        }catch(TableGatewayRecordNotFoundException $tableGatewayRecordNotFoundException){
            return false;
        }
    }
}
