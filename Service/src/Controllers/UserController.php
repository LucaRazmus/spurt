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
}
