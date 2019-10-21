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
    public function fetchForPaginatedPages(int $limit = 20, int $page = 1): object
    {
        $offset = $limit * $page - $limit;

        $posts = $this->createBuilder()
            ->limit($limit)
            ->offset($offset);

        $this->selectActive($posts);

        return $posts->getQuery()->execute();
    }

    /**
     *
     * @return Phalcon\Mvc\Model\Resultset\Simple
     */
    public function fetchAll(): object
    {

        $posts = $this->createBuilder();

        $this->selectActive($posts);

        return $posts->getQuery()->execute();
    }

    /**
     *
     * @param int $id
     * @return Phalcon\Mvc\Model\Resultset\Simple
     */
    public function fetchById(int $id): object
    {

        $post = $this->createBuilder()
            ->where('id = :id:', ['id' => $id]);

        $this->selectActive($post);

        return $post->getQuery()->execute()->getFirst();
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

    /**
     * @param BuilderInterface $builder
     * @return $this
     */
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
