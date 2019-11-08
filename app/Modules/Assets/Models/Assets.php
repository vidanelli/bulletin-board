<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Assets\Models;

use App\Core\Mvc\Model;

class Assets extends Model
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
     * @Column(type="varchar", length=255, default='', nullable=false)
     */
    protected $path;
    /**
     * @var int
     * @Column(type="integer", length=11, default=0, nullable=false)
     */
    protected $created_by_user_id;
    /**
     * @var int
     * @Column(type="integer", length=11, default=0, nullable=false)
     */
    protected $updated_by_user_id;
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
     * @Column(type="integer", length=1, default=1, nullable=false)
     */
    protected $active;
    /**
     * @var int
     * @Column(type="integer", length=1, default=0, nullable=false)
     */
    protected $deleted;

    /**
     * @var array
     */
    protected $append = ['src'];

    public function beforeCreate()
    {
        /**
         * @var \Carbon\Carbon $datetime
         */
        $datetime = $this->getDI()->get('datetime');
        /**
         * @var App\Modules\Users\Services\AuthService $auth
         */
        $auth = $this->getDI()->get('auth');

        $this->setCreatedAt($datetime->toDateTimeString());
        $this->setUpdatedAt($datetime->toDateTimeString());
        if ($auth->isUserLogged()) {
            $this->setCreatedByUserId($auth->getLoggedUser()->getId());
            $this->setUpdatedByUserId($auth->getLoggedUser()->getId());
        }
    }

    public function beforeUpdate()
    {
        /**
         * @var \Carbon\Carbon $datetime
         */
        $datetime = $this->getDI()->get('datetime');
        /**
         * @var App\Modules\Users\Services\AuthService $auth
         */
        $auth = $this->getDI()->get('auth');

        $this->setUpdatedAt($datetime->toDateTimeString());
        if ($auth->isUserLogged()) {
            $this->setUpdatedByUserId($auth->getLoggedUser()->getId());
        }
    }

    public function beforeDelete()
    {
        $filesystem = $this->getDI()->get('filesystem');

        return $filesystem->delete('storage://' . $this->getPath() . $this->getName());
    }

    public function getSrc()
    {
        if ($this->name) {
            return DIRECTORY_SEPARATOR . 'storage/' . $this->path . $this->name;
        }
        return null;
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
     * @return Assets
     */
    public function setId(int $id): Assets
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
     * @return Assets
     */
    public function setName(string $name): Assets
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Assets
     */
    public function setPath(string $path): Assets
    {
        $this->path = $path;
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
     * @return Assets
     */
    public function setCreatedByUserId(int $created_by_user_id): Assets
    {
        $this->created_by_user_id = $created_by_user_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUpdatedByUserId(): int
    {
        return $this->updated_by_user_id;
    }

    /**
     * @param int $updated_by_user_id
     * @return Assets
     */
    public function setUpdatedByUserId(int $updated_by_user_id): Assets
    {
        $this->updated_by_user_id = $updated_by_user_id;
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
     * @return Assets
     */
    public function setCreatedAt(string $created_at): Assets
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
     * @return Assets
     */
    public function setUpdatedAt(string $updated_at): Assets
    {
        $this->updated_at = $updated_at;
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
     * @return Assets
     */
    public function setActive(int $active): Assets
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
     * @return Assets
     */
    public function setDeleted(int $deleted): Assets
    {
        $this->deleted = $deleted;
        return $this;
    }

}
