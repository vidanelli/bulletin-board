<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Home\Controllers;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $limit = 20;
        $page = $this->request->getQuery('page', 'int', 1);

        $this->view->setVars([
            'Posts' => $this->postsRepository->fetchForPaginatedPages($limit, $page),
            'Paginator' => $this->postsRepository->getPaginator($limit, $page)
        ]);
    }

    public function notFoundAction()
    {
        return "404 | Page Not Found";
    }

}
