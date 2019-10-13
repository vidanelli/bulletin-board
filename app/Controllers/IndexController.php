<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

use BulletinBoardProject\Models\Posts;
use Phalcon\Paginator\Adapter\QueryBuilder;
use BulletinBoardProject\Repositories\PagesRepository;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $limit = 20;
        $page = $this->request->getQuery('page', 'int', 1);

        $pagesRepository = new PagesRepository();

        $this->view->setVars([
            'Posts' => $pagesRepository->fetchAll($limit, $page),
            'Paginator' => $pagesRepository->getPaginator($limit, $page)
        ]);
    }

}
