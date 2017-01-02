<?php
namespace Spurt\Models;

use Spurt\Models\Base\BaseCharactersModel;

class CharactersModel extends BaseCharactersModel
{
    public function __toPublicArray()
    {
        $character = parent::__toArray();

        unset($character['Id'], $character['UserId']);

        $character['LinkToProfile'] = "/v1/characters/{$this->getUuid()}";
        return $character;
    }
}
