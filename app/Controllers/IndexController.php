<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Controllers;

use BulletinBoardProject\Models\Posts\Posts;
use Phalcon\Paginator\Adapter\QueryBuilder;
use BulletinBoardProject\Repositories\Posts\PostsRepository;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $limit = 20;
        $page = $this->request->getQuery('page', 'int', 1);

        $postsRepository = new PostsRepository();

        $this->view->setVars([
            'Posts' => $postsRepository->fetchForPaginatedPages($limit, $page),
            'Paginator' => $postsRepository->getPaginator($limit, $page)
        ]);
    }

    public function notFoundAction()
    {
        return "404 | Page Not Found";
    }

}
