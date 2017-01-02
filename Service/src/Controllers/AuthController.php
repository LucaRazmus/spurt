<?php

namespace Spurt\Controllers;

use Spurt\Models\UsersModel;
use Spurt\Services\AuthService;
use Segura\AppCore\Abstracts\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthController extends Controller
{

    /** @var AuthService */
    private $authService;

    public function __construct(
        AuthService $authService
    ) {
        $this->authService = $authService;
    }

    public function doLogin(Request $request, Response $response, $args)
    {
        $user = $this->authService->doLogin($request->getParsedBodyParam('username'), $request->getParsedBodyParam('password'));
        if ($user instanceof UsersModel) {
            $session = $this->authService->createSession($user);
            return $response->withJson([
                'Status'  => 'Okay',
                'Session' => $session->getKey(),
            ], 200);
        } else {
            return $response->withJson([
                'Status' => 'Denied'
            ], 400);
        }
    }
}
