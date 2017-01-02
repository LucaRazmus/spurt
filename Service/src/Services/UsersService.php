<?php
namespace Spurt\Services;

use Segura\AppCore\Exceptions\TableGatewayException;
use Segura\Session\Session;
use Spurt\Models\SessionsModel;
use Spurt\Services\Base\BaseUsersService;

class UsersService extends BaseUsersService
{
    /**
     * @param $emailOrUsername
     * @param $password
     * @param int $lifespan
     * @return false|SessionsModel
     */
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

        // Create Session
        $session = SessionsModel::factory()
            ->setStart(date("Y-m-d H:i:s"))
            ->setEnd(date("Y-m-d H:i:s", time() + $lifespan))
            ->setUserId($user->getId())
            ->save();

        Session::set("session_id", $session->getId());

        return $session;
    }
}
