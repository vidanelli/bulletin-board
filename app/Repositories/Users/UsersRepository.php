<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Repositories\Users;

use BulletinBoardProject\Repositories\Repository;
use BulletinBoardProject\Models\Users\Users;

class UsersRepository extends Repository
{
    /**
     * UsersRepository constructor.
     */
     public function __construct()
     {
         parent::__construct();

         $this->setModel(Users::class);
     }

    /**
     * @param int $id
     * @return Users|null
     */
    public function findById(int $id): ?Users
    {
        $user = $this->modelsManager->createBuilder()
            ->from([$this->getTmpTable() => Users::class])
            ->where("{$this->getTmpTable()}.id = :id:", ['id' => $id])
            ->andWhere("{$this->getTmpTable()}.active = 1")
            ->getQuery()
            ->execute()
            ->getFirst();

        return $user;
    }

    /**
    * @param string $email
    * @return Users|null
    */
    public function findByEmail(string $email): ?Users
    {
        $user = $this->modelsManager->createBuilder()
            ->from([$this->getTmpTable() => Users::class])
            ->where("{$this->getTmpTable()}.email = :email:", ['email' => $email])
            ->andWhere("{$this->getTmpTable()}.active = 1")
            ->getQuery()
            ->execute()
            ->getFirst();

        return $user;
    }
}
