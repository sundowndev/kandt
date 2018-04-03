<?php

namespace App\Controller;

use App\Repository\PageRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     * @Method("GET")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig',
            [
                'title' => 'Dashboard'
            ]
        );
    }

    /**
     * @Route("/admin/pages", name="admin")
     * @Method("GET")
     */
    public function pagesAction()
    {
        return $this->render('admin/pages.html.twig',
            [
                'title' => 'Pages'
            ]
        );
    }

    /**
     * @Route("/admin/pages/create", name="create_page")
     * @Method("GET")
     */
    public function createPageAction()
    {
        return $this->render('admin/create_page.html.twig',
            [
                'title' => 'Créer une page'
            ]
        );
    }

    /**
     * @Route("/admin/pages/create", name="create_page_post")
     * @Method("POST")
     */
    public function createPagePostAction()
    {
        //return $this->render('admin/create_page.html.twig');
    }

    /**
     * @Route("/admin/pages/{slug}", name="edit_page")
     * @Method("GET")
     */
    public function editPageAction($slug, PageRepository $pages)
    {
        $page = $pages->findOneBy(['slug' => $slug]);

        if (!$page) {
            throw new NotFoundHttpException();
        }

        return $this->render('admin/create_page.html.twig',
            [
                'title' => 'Créer une page',
                'page' => $page
            ]
        );
    }

    /**
     * @Route("/admin/pages/{slug}", name="edit_page_post")
     * @Method("POST")
     */
    public function editPagePostAction($slug)
    {
        if (!$page) {
            throw new NotFoundHttpException();
        }

        //return $this->render('admin/create_page.html.twig');
    }

    /**
     * @Route("/admin/pages/delete", name="delete_page")
     * @Method("POST")
     */
    public function deletePagePostAction()
    {
        //return $this->render('admin/create_page.html.twig');
    }
}