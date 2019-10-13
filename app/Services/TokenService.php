<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services;

use Carbon\Carbon;
use BulletinBoardProject\Models\{UserInterface, UserTokens};
use Phalcon\Di\Injectable;
use Phalcon\Security\Random;

class TokenService extends Injectable
{

    /**
     * @var Random
     */
    protected $random;

    /**
     * TokenService constructor.
     */
    public function __construct()
    {
        $this->random = new Random();
    }

    /**
     * @param UserInterface $user
     * @return UserTokens
     * @throws \Phalcon\Security\Exception
     */
    public function generate(UserInterface $user): UserTokens
    {
        return $this->createToken($user);
    }

    /**
     * @param UserInterface $user
     * @return UserTokens
     * @throws \Phalcon\Security\Exception
     */
    protected function createToken(UserInterface $user): UserTokens
    {
        $userToken = new UserTokens();
        $userToken->setUserId($user->getId())
            ->setIp($this->request->getClientAddress())
            ->setUserAgent($this->request->getUserAgent())
            ->setToken($this->random->base64(32))
            ->setExpires($this->datetime->now()->addDays(30)->toDateTimeString())
            ->save();

        return $userToken;
    }

    /**
     * @param string $tokenValue
     * @return bool|UserTokens
     */
    public function tokenIsValid(string $tokenValue)
    {
        $token = $this->findByToken($tokenValue);
        if ($token && (Carbon::parse($token->getExpires()) > Carbon::now())) {
            return $token;
        }

        return false;
    }

    /**
     * @param string $token
     * @return bool|UserTokens
     */
    protected function findByToken(string $token)
    {
        return $this->modelsManager->createBuilder()
            ->from(UserTokens::class)
            ->where('token = :token:', ['token' => $token])
            ->getQuery()
            ->execute()
            ->getFirst();
    }

    /**
     * Deleting UserTokens model.
     *
     * @param string $tokenValue
     * @return bool
     */
    public function deleteToken(string $tokenValue): bool
    {
        $token = $this->findByToken($tokenValue);
        if ($token) {
            return $token->delete();
        }

        return false;
    }
}
