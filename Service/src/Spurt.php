<?php
namespace Spurt;

use Slim\Views\Twig;
use Spurt\Middleware\EnvironmentHeadersOnResponse;
use Segura\AppCore\App;

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

    }
}
