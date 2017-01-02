<?php

namespace Spurt\Controllers;

use Slim\Views\Twig;
use Segura\AppCore\Abstracts\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use Spurt\Services\UsersService;

class UserController extends Controller
{

    /** @var UsersService */
    protected $usersService;
    /** @var Twig */
    protected $twig;

    public function __construct(
        UsersService $usersService,
        Twig $twig
    ) {
        $this->usersService = $usersService;
        $this->twig = $twig;
    }

    public function showLogin(Request $request, Response $response, $args)
    {
        return $this->twig->render($response, 'login/login.html.twig', [
        ]);
    }

    public function doLogin(Request $request, Response $response, $args)
    {

        $email = $request->getParsedBodyParam("email");
        $password = $request->getParsedBodyParam("password");
        $remember = $request->getParsedBodyParam("rememberme") == "remember-me" ? true : false;
        \Kint::dump(
            $email,
            $password,
            $remember
        );

        $this->usersService->doLogin($email, $password, $remember ? DEFAULT_SESSION_LIFESPAN * 364 : DEFAULT_SESSION_LIFESPAN);
    }
}
