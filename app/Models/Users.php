<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Models;

use BulletinBoardProject\Models\Assets;
use Phalcon\Mvc\Model;

class Users extends Model implements UserInterface
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
     * @Column(type="varchar", length=255, default='', nullable=false)
     */
    protected $email;
    /**
     * @var string
     * @Column(type="varchar", length=255, default='', nullable=false)
     */
    protected $password;
    /**
     * @var string|null
     * @Column(type="varchar", length=255, default='', nullable=false)
     */
    protected $first_name;
    /**
     * @var string|null
     * @Column(type="varchar", length=255, default='', nullable=true)
     */
    protected $last_name;
    /**
     * @var string|null
     * @Column(type="varchar", length=255, default='', nullable=true)
     */
    protected $gender;
    /**
     * @var string|null
     * @Column(type="date", default='0000-00-00', nullable=true)
     */
    protected $birthday;
    /**
     * @var string|null
     * @Column(type="varchar", length=255, default='', nullable=true)
     */
    protected $location;
    /**
     * @var string|null
     * Column(type="mediumtext", length=255, default='', nullable=true)
     */
    protected $about_me;
    /**
     * @var int
     * @Column(type="integer", length=11, default='0', nullable=false)
     */
    protected $avatar;
    /**
     * @var string
     * @Column(type="datetime", default='0000-00-00 00:00:00', nullable=false)
     */
    protected $created_at;
    /**
     * @var string
     * @Column(type="datetime", default='0000-00-00 00:00:00', nullable=false)
     */
    protected $updated_at;
    /**
     * @var string
     * @Column(type="varchar", length=45, default='', nullable=true)
     */
    protected $ip;
    /**
     * @var int
     * @Column(type="integer", length=1, default=1, nullable=false)
     */
    protected $active;

    public function initialize()
    {
        $this->hasOne('avatar', Assets::class, 'id', [
            'alias' => 'UserAvatar',
        ]);

    }

    public function beforeCreate()
    {
        $this->setCreatedAt($this->getDI()->get('datetime')->toDateTimeString());
        $this->setUpdatedAt($this->getDI()->get('datetime')->toDateTimeString());
    }

    public function beforeUpdate()
    {
        $this->setUpdatedAt($this->getDI()->get('datetime')->toDateTimeString());
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Users
     */
    public function setId(int $id): Users
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Users
     */
    public function setEmail(string $email): Users
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Users
     */
    public function setPassword(string $password): Users
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     * @return Users
     */
    public function setFirstName(string $first_name): Users
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     * @return Users
     */
    public function setLastName(string $last_name): Users
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return Users
     */
    public function setGender(string $gender): Users
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     * @return Users
     */
    public function setBirthday(string $birthday): Users
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Users
     */
    public function setLocation(string $location): Users
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAboutMe(): ?string
    {
        return $this->about_me;
    }

    /**
     * @param string $about_me
     * @return Users
     */
    public function setAboutMe(string $about_me): Users
    {
        $this->about_me = $about_me;
        return $this;
    }

    /**
     * @return int
     */
    public function getAvatar(): int
    {
        return $this->avatar;
    }

    /**
     * @param int $avatar
     * @return Users
     */
    public function setAvatar(int $avatar): Users
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     * @return Users
     */
    public function setCreatedAt(string $created_at): Users
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     * @return Users
     */
    public function setUpdatedAt(string $updated_at): Users
    {
        $this->updated_at = $updated_at;
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
     * @return Users
     */
    public function setIp(string $ip): Users
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @param int $active
     * @return Users
     */
    public function setActive(int $active): Users
    {
        $this->active = $active;
        return $this;
    }

}
