<?php

namespace Spurt\Controllers;

use Spurt\Models\CharactersModel;
use Spurt\Models\MessagesModel;
use Spurt\Models\UsersModel;
use Spurt\Services\AuthService;
use Spurt\Services\CharactersService;
use Spurt\Services\MessagesService;
use Spurt\Services\SessionsService;
use Segura\AppCore\Abstracts\Controller;
use Segura\AppCore\Exceptions\TableGatewayRecordNotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;

class MessageController extends Controller
{
    protected $sessionsService;
    protected $charactersService;
    protected $messagesService;

    public function __construct(
        SessionsService $sessionsService,
        CharactersService $charactersService,
        MessagesService $messagesService
    ) {
        $this->sessionsService = $sessionsService;
        $this->charactersService = $charactersService;
        $this->messagesService = $messagesService;
    }

    public function getMessages(Request $request, Response $response, $args)
    {
        // Check Session
        $user = $this->sessionsService->validateSession($request->getParsedBodyParam('sessionKey'));
        if(!$user instanceof UsersModel){
            return $response->withJson(['Status' => 'Fail', 'Reason' => 'Bad Session Key'], 400);
        }

        $messages = [];

        /** @var CharactersModel $character */
        foreach($user->fetchCharacterObjects() as $character){
            $messages = array_merge($messages, $character->fetchMessageByCharacterToIdObjects());
        }

        /** @var MessagesModel $message */
        foreach($messages as &$message){
            $message = $message->__toPublicArray();
        }

        return $response->withJson([
            'Status' => 'Okay',
            'Messages' => $messages
        ]);
    }

    public function sendMessage(Request $request, Response $response, $args)
    {
        // Check Session
        $user = $this->sessionsService->validateSession($request->getParsedBodyParam('sessionKey'));
        if(!$user instanceof UsersModel){
            return $response->withJson(['Status' => 'Fail', 'Reason' => 'Bad Session Key'], 400);
        }

        // Check User is owner of Character
        try {
            $fromCharacter = $this->charactersService->getByField('uuid', $request->getParsedBodyParam('characterUUID'));
        }catch(TableGatewayRecordNotFoundException $tableGatewayRecordNotFoundException){
            return $response->withJson(['Status' => 'Fail', 'Reason' => 'Cannot send from non-existent character'], 400);
        }
        if($fromCharacter->getUserId() != $user->getId()){
            return $response->withJson(['Status' => 'Fail', 'Reason' => 'Cannot send from character that does not belong to you.'], 400);
        }

        // Check User is NOT owner of Target
        try {
            $toCharacter = $this->charactersService->getByField('uuid', $request->getParsedBodyParam('targetUUID'));
        }catch(TableGatewayRecordNotFoundException $tableGatewayRecordNotFoundException){
            return $response->withJson(['Status' => 'Fail', 'Reason' => 'Cannot send to non-existent character'], 400);
        }
        if($toCharacter->getUserId() == $user->getId()){
            return $response->withJson(['Status' => 'Fail', 'Reason' => 'Cannot send to character that belongs to you.'], 400);
        }

        $message = $this->messagesService->send($fromCharacter, $toCharacter, $request->getParsedBodyParam('message'));

        return $response->withJson([
            'Status' => 'Okay',
            'Message' => $message->__toArray()
        ]);
    }
}
