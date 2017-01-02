<?php
namespace Spurt;

use Spurt\Middleware\EnvironmentHeadersOnResponse;
use Segura\AppCore\App;

class Spurt extends App
{
    public function __construct()
    {
        parent::__construct();

        $this->app->add(new EnvironmentHeadersOnResponse());

    }
}
