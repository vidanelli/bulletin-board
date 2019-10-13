<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Repositories;

use BulletinBoardProject\Models\Users;
use Phalcon\Di\Injectable;

class UsersRepository extends Injectable
{
    /**
     * @param int $id
     * @return Users|null
     */
    public function findById(int $id): ?Users
    {
        $user = $this->modelsManager->createBuilder()
            ->from(['User' => Users::class])
            ->where('User.id = :id:', ['id' => $id])
            ->andWhere('User.active = 1')
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
            ->from(['User' => Users::class])
            ->where('User.email = :email:', ['email' => $email])
            ->andWhere('User.active = 1')
            ->getQuery()
            ->execute()
            ->getFirst();

        return $user;
    }
}
