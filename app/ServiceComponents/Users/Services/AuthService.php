<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\ServiceComponents\Users\Services;

use BulletinBoardProject\Models\Users\UserInterface;
use BulletinBoardProject\Repositories\Users\UsersRepository;
use Phalcon\Di\Injectable;

class AuthService extends Injectable
{
    /**
     * @var BulletinBoardProject\Services\TokenService
     */
    protected $tokenService;

    /**
     * AuthService constructor
     * @param BulletinBoardProject\Services\TokenService $tokenService
     */
    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return bool
     */
    public function login(string $email, string $password, bool $remember): bool
    {
        $user = (new UsersRepository())->findByEmail($email);

        if ($user && $this->security->checkHash($password, $user->getPassword())) {

            $this->authenticate($user, $remember);

            return true;
        }

        $this->security->hash(rand());

        return false;
    }

    /**
     * @return bool
     */
    public function logout()
    {
        return $this->expire();
    }

    /**
     * @param UserInterface $user
     * @param bool $remember
     * @return AuthService $this
     */
    public function authenticate(UserInterface $user, bool $remember = false): AuthService
    {
        $this->expire();

        $this->session->set('user_id', $user->getId());

        if ($remember) {
            $this->remember($user);
        }

        return $this;
    }

    /**
     * @return bool
     */
    protected function expire(): bool
    {
        if ($this->cookies->has('GUT')) {
            $this->tokenService->deleteToken($this->cookies->get('GUT')->getValue());
            $this->cookies->delete('GUT');
        }
        $this->session->remove('user_id');
        return true;
    }

    /**
     * @param UserInterface $user
     * @return AuthService $this
     */
    protected function remember(UserInterface $user): AuthService
    {
        $token = $this->tokenService->generate($user);
        $this->cookies->set('GUT', $token->getToken(), 'time()+' . $this->datetime->now()->diffInSeconds($token->getExpires()));

        return $this;
    }

    /**
     * @return UserInterface|null
     */
    public function getLoggedUser(): ?UserInterface
    {
        if ($this->session->has('user_id')) {
            return (new UsersRepository())->findById($this->session->get('user_id'));
        }

        if ($this->cookies->has('GUT')) {
            $token = $this->tokenService->tokenIsValid($this->cookies->get('GUT')->getValue());
            if ($token !== false) {
                $user = (new UsersRepository())->findById($token->getUserId());
                $this->authenticate($user);
                return $user;
            }
        }

        return null;
    }

    /**
     * @return bool
     */
    public function isUserLogged(): bool
    {
        if ($this->getLoggedUser()) {
            return true;
        }
        return false;
    }
}
