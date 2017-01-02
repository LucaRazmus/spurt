<?php

namespace Spurt\Controllers;

use Spurt\Models\CharactersModel;
use Spurt\Models\UsersModel;
use Spurt\Services\AuthService;
use Spurt\Services\CharactersService;
use Segura\AppCore\Abstracts\Controller;
use Segura\AppCore\Exceptions\TableGatewayRecordNotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;

class DashboardController extends Controller
{

    public function __construct(
    ) {

    }

    public function showDashboard(Request $request, Response $response, $args){
        return $response->withRedirect("/login");

    }
}
