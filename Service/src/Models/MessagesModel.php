<?php
namespace Spurt\Models;

use Spurt\Models\Base\BaseMessagesModel;

class MessagesModel extends BaseMessagesModel
{
    public function __toPublicArray()
    {
        $array = parent::__toArray();

        unset(
            $array['Id'],
            $array['CharacterFromId'],
            $array['CharacterToId']
        );

        $array['CharacterFrom'] = $this->fetchCharacterByCharacterFromIdObject()->__toPublicArray();
        $array['CharacterTo'] = $this->fetchCharacterByCharacterToIdObject()->__toPublicArray();

        return $array;
    }
}
