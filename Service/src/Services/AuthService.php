<?php

namespace Spurt\Services;

use Spurt\Models\SessionsModel;
use Spurt\Models\UsersModel;
use Thru\UUID\UUID;

class AuthService
{

    /** @var UsersService */
    private $usersService;
    /** @var SessionsService */
    private $sessionsService;

    public function __construct(
        UsersService $usersService,
        SessionsService $sessionsService
    ) {
        $this->usersService    = $usersService;
        $this->sessionsService = $sessionsService;
    }

    public function doLogin(string $username, string $password)
    {
        $user = $this->usersService->getByField('username', $username);
        if (password_verify($password, $user->getPassword())) {
            return $user;
        } else {
            return false;
        }
    }

    /**
     * @param UsersModel $user
     *
     * @return SessionsModel
     */
    public function createSession(UsersModel $user)
    {
        return SessionsModel::factory()
            ->setUserId($user->getId())
            ->setCreated(date("Y-m-d H:i:s", strtotime("now")))
            ->setExpires(date("Y-m-d H:i:s", strtotime("5 minutes from now")))
            ->setUuid(UUID::v4())
            ->setKey(UUID::v4())
            ->save();
    }
}
