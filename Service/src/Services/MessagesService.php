<?php
namespace Spurt\Services;

use Spurt\Models\CharactersModel;
use Spurt\Models\MessagesModel;
use Spurt\Services\Base\BaseMessagesService;
use Thru\UUID\UUID;

class MessagesService extends BaseMessagesService
{
    /**
     * @param CharactersModel $fromCharacter
     * @param CharactersModel $toCharacter
     * @param string $message
     * @return MessagesModel
     */
    public function send(CharactersModel $fromCharacter, CharactersModel $toCharacter, string $message){
        return MessagesModel::factory()
            ->setUuid(UUID::v4())
            ->setCharacterFromId($fromCharacter->getId())
            ->setCharacterToId($toCharacter->getId())
            ->setMessage($message)
            ->setDateCreated(date("Y-m-d H:i:s"))
            ->save();
    }
}
