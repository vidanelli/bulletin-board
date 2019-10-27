<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Repositories;

use Phalcon\Di\Injectable;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query\BuilderInterface;
use Phalcon\Paginator\Adapter\QueryBuilder;

abstract class Repository extends Injectable
{
    /**
     * @var string
     */
    protected $model;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param string $model
     * @return void
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getTmpTable(): string
    {
        return substr($this->getModel(), 0, -1);
    }

    /**
     * @return BuilderInterface
     */
    protected function createBuilder(): BuilderInterface
    {
        $builder = $this->modelsManager
            ->createBuilder()
            ->from([$this->getTmpTable() => $this->getModel()]);

        return $builder;
    }

    /**
     * @param BuilderInterface $builder
     * @return Repository
     */
    protected function selectActive(BuilderInterface $builder): Repository
    {
        $builder->andWhere("{$this->getTmpTable()}.active = :active:", ['active' => 1])
            ->andWhere("{$this->getTmpTable()}.deleted = :deleted:", ['deleted' => 0]);

        return $this;
    }

    /**
     * @param int $limit
     * @param int $page
     * @return \stdClass
     */
    public function getPaginator(int $limit = 20, int $page = 1): \stdClass
    {
        $builder = $this->createBuilder()
            ->columns("{$this->getTmpTable()}.id");

        $this->selectActive($builder);

        return $this->paginate($builder, $limit, $page);
    }


    /**
     * @param BuilderInterface $builder
     * @param int $limit
     * @param int $page
     * @return \stdClass
     */
    protected function paginate(BuilderInterface $builder, int $limit = 20, int $page = 1): \stdClass
    {
        $paginator = new QueryBuilder([
            "builder" => $builder,
            "limit" => $limit,
            "page" => $page,
        ]);

        return $paginator->getPaginate();
    }

    /**
     *
     * @param int $id
     * @return Phalcon\Mvc\Model\Resultset\Simple|null
     */
    public function fetchById(int $id): ?object
    {
        $builder = $this->createBuilder()
            ->where("{$this->getTmpTable()}.id = :id:", ['id' => $id]);

        $this->selectActive($builder);

        return $builder->getQuery()->execute()->getFirst();
    }

    /**
     *
     * @return Phalcon\Mvc\Model\Resultset\Simple|null
     */
    public function fetchAll(): ?object
    {
        $builder = $this->createBuilder();

        $this->selectActive($builder);

        return $builder->getQuery()->execute();
    }
}
