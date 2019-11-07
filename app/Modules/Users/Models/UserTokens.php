<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Users\Models;

use Phalcon\Mvc\Model;

class UserTokens extends Model
{
    /**
     * @var int
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;
    /**
     * @var string
     * @Column(type="varchar", length=64, default='', nullable=false)
     */
    protected $token;
    /**
     * @var int
     * @Column(type="integer", length=11, default=0, nullable=false)
     */
    protected $user_id;
    /**
     * @var string
     * @Column(type="datetime", default='0000-00-00 00:00:00', nullable=false)
     */
    protected $expires;
    /**
     * @var string
     * @Column(type="varchar", length=45, default='', nullable=true)
     */
    protected $ip;
    /**
     * @var mixed
     * @Column(type="text", default='', nullable=true)
     */
    protected $user_agent;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserTokens
     */
    public function setId(int $id): UserTokens
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return UserTokens
     */
    public function setToken(string $token): UserTokens
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return UserTokens
     */
    public function setUserId(int $user_id): UserTokens
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpires(): string
    {
        return $this->expires;
    }

    /**
     * @param string $expires
     * @return UserTokens
     */
    public function setExpires(string $expires): UserTokens
    {
        $this->expires = $expires;
        return $this;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return UserTokens
     */
    public function setIp(string $ip): UserTokens
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $this->user_agent;
    }

    /**
     * @param mixed $user_agent
     * @return UserTokens
     */
    public function setUserAgent($user_agent)
    {
        $this->user_agent = $user_agent;
        return $this;
    }


}
