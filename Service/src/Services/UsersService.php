<?php
namespace Spurt\Services;

use Segura\AppCore\Exceptions\TableGatewayException;
use Spurt\Services\Base\BaseUsersService;

class UsersService extends BaseUsersService
{
    public function doLogin($emailOrUsername, $password, $lifespan = DEFAULT_SESSION_LIFESPAN){
        try {
            $foundByUsername = $this->getByField("username", $emailOrUsername);
        }catch(TableGatewayException $tge){
            // No match
        }
        try {
            $foundByEmail = $this->getByField("email", $emailOrUsername);
        }catch(TableGatewayException $tge){
            // No match
        }
        if($foundByEmail){
            $user = $foundByEmail;
        }elseif($foundByUsername){
            $user = $foundByUsername;
        }else{
            return false;
        }

    }
}
