<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;

class Posts extends Model
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
    protected $name;
    /**
     * @var string
     * @Column(type="mediumtext", default='', nullable=false)
     */
    protected $description;
    /**
     * @var int
     * @Column(type="integer", length=11, default=0, nullable=false)
     */
    protected $image_id;
    /**
     * @var string
     * @Column(type="datetime", default='0000-00-00 00:00:00', nullable=false)
     */
    protected $created_at;
    /**
     * @var string
     * @Column(type="datetime", default='0000-00-00 00:00:00', nullable=true)
     */
    protected $updated_at;
    /**
     * @var int
     * @Column(type="integer", length=11, default=0, nullable=false)
     */
    protected $created_by_user_id;
    /**
     * @var int
     * @Column(type="integer", length=1, default=1, nullable=false)
     */
    protected $active;
    /**
     * @var int
     * @Column(type="integer", length=1, default=0, nullable=false)
     */
    protected $deleted;

    public function initialize()
    {

        $this->hasOne('image_id', Assets::class, 'id', [
            'alias' => 'Image',
            'reusable' => true,
        ]);

        $this->hasOne('created_by_user_id', Users::class, 'id', [
            'alias' => 'User',
            'reusable' => true,
        ]);

    }

    public function beforeCreate()
    {
        $this->setCreatedAt($this->getDI()->get('datetime')->toDateTimeString());
        $this->setUpdatedAt($this->getDI()->get('datetime')->toDateTimeString());

        if ($auth->isUserLogged()) {
            $this->setCreatedByUserId($this->getDI()->get('auth')->getLoggedUser()->getId());
            $this->setUpdatedByUserId($this->getDI()->get('auth')->getLoggedUser()->getId());
        }
    }

    public function beforeUpdate()
    {
        $this->setUpdatedAt($this->getDI()->get('datetime')->toDateTimeString());

        if ($auth->isUserLogged()) {
            $this->setUpdatedByUserId($this->getDI()->get('auth')->getLoggedUser()->getId());
        }
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
     * @return Posts
     */
    public function setId(int $id): Posts
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Posts
     */
    public function setName(string $name): Posts
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Posts
     */
    public function setDescription(string $description): Posts
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getImageId(): int
    {
        return $this->image_id;
    }

    /**
     * @param int $image_id
     * @return Posts
     */
    public function setImageId(int $image_id): Posts
    {
        $this->image_id = $image_id;
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
     * @return Posts
     */
    public function setCreatedAt(string $created_at): Posts
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     * @return Posts
     */
    public function setUpdatedAt(string $updated_at): Posts
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedByUserId(): int
    {
        return $this->created_by_user_id;
    }

    /**
     * @param int $created_by_user_id
     * @return Posts
     */
    public function setCreatedByUserId(int $created_by_user_id): Posts
    {
        $this->created_by_user_id = $created_by_user_id;
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
     * @return Posts
     */
    public function setActive(int $active): Posts
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return int
     */
    public function getDeleted(): int
    {
        return $this->deleted;
    }

    /**
     * @param int $deleted
     * @return Posts
     */
    public function setDeleted(int $deleted): Posts
    {
        $this->deleted = $deleted;
        return $this;
    }


}
