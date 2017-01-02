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

class CharacterController extends Controller
{
    /** @var CharactersService */
    private $charactersService;

    public function __construct(
        CharactersService $charactersService
    ) {
        $this->charactersService = $charactersService;
    }

    public function listCharacters(Request $request, Response $response, $args){
        $characters = [];
        foreach($this->charactersService->getAll() as $character){
            $char = $character->__toPublicArray();
            unset($char['Description']);
            $char['LinkToProfile'] = "/v1/characters/{$character->getUuid()}";
            $characters[] = $char;
        }
        return $response->withJson([
            'Status'  => 'Okay',
            'Character' => $characters,
        ], 200);
    }

    public function getCharacter(Request $request, Response $response, $args){
        try {
            $character = $this->charactersService->getByField('uuid', $args['uuid']);
        }catch(TableGatewayRecordNotFoundException $exception){
            $character = false;
        }

        if($character instanceof CharactersModel){
            return $response->withJson([
                'Status'  => 'Okay',
                'Character' => $character->__toArray(),
            ], 200);
        } else {
            return $response->withJson([
                'Status' => 'Does not exist'
            ], 404);
        }
    }

}
