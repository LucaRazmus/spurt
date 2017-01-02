<?php
namespace Spurt;

use Segura\Session\Session;
use Slim\Views\Twig;
use Spurt\Middleware\EnvironmentHeadersOnResponse;
use Segura\AppCore\App;
use Spurt\Models\SessionsModel;
use Spurt\Services\SessionsService;

class Spurt extends App
{
    public function __construct()
    {
        parent::__construct();

        $this->app->add(new EnvironmentHeadersOnResponse());

        /** @var Twig $view */
        $view = $this->getContainer()->get("view");
        $view->offsetSet('project_name', APP_NAME);
        $view->offsetSet('copyright_year', date("Y"));

        $session_id = Session::get('session_id');
        if($session_id){
            #$session =
            #$user =
        }
        $view->offsetSet('user', isset($user) ? $user : false);

    }
}
