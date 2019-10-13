<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Repositories;

use BulletinBoardProject\Models\Posts;
use Phalcon\Mvc\Model\Query\BuilderInterface;
use Phalcon\Paginator\Adapter\QueryBuilder;
use Phalcon\Di\Injectable;

class PagesRepository extends Injectable
{
    /**
     * @param int $limit
     * @param int $page
     * @return Phalcon\Mvc\Model\Resultset\Simple
     */
    public function fetchAll(int $limit = 20, int $page = 1): object
    {
        $offset = $limit * $page - $limit;

        $posts = $this->modelsManager
            ->createBuilder()
            ->from(Posts::class)
            ->where('active = 1')
            ->andWhere('deleted = 0')
            ->limit($limit)
            ->offset($offset)
            ->getQuery()
            ->execute();

        return $posts;
    }
    /**
     * @param int $limit
     * @param int $page
     * @return \stdClass
     */
    public function getPaginator(int $limit = 20, int $page = 1): object
    {
        $builder = $this->createBuilder()
            ->columns('Page.id');

        $this->selectActive($builder);

        return $this->paginate($builder, $limit, $page);
    }

    /**
     * @return \Phalcon\Mvc\Model\Query\BuilderInterface
     */
    protected function createBuilder(): BuilderInterface
    {
        $builder = $this->modelsManager
            ->createBuilder()
            ->from(['Page' => Posts::class]);

        return $builder;
    }

    protected function selectActive(BuilderInterface $builder)
    {
        $builder->andWhere('Page.active = :active:', ['active' => 1])
            ->andWhere('Page.deleted = :deleted:', ['deleted' => 0]);
        return $this;
    }

    /**
     * @param BuilderInterface $builder
     * @param int $limit
     * @param int $page
     * @return \stdClass
     */
    protected function paginate(BuilderInterface $builder, int $limit = 20, int $page = 1)
    {
        $paginator = new QueryBuilder([
            "builder" => $builder,
            "limit" => $limit,
            "page" => $page,
        ]);

        return $paginator->getPaginate();
    }
}
