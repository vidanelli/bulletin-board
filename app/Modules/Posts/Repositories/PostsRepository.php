<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Posts\Repositories;

use App\Core\Repository\SqlRepository;
use App\Modules\Posts\Models\Posts;
use Phalcon\Mvc\Model\Query\BuilderInterface;
use Phalcon\Paginator\Adapter\QueryBuilder;

class PostsRepository extends SqlRepository
{
    /**
     * PostsRepository constructor.
     */
     public function __construct()
     {
         parent::__construct();

         $this->setModel(Posts::class);
     }

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
}
