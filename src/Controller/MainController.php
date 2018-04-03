<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Page;
use App\Repository\PageRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Method("GET")
     */
    public function index(PageRepository $PageRepository)
    {
        $pages = $PageRepository->findAll();

        return $this->render('main/index.html.twig',
            [
                'pages' => $pages
            ]
        );
    }

    /**
     * @Route("/page/{slug}", requirements={"page": "[1-9]\d*"}, name="single_page")
     * @Method("GET")
     */
    public function page($slug, PageRepository $PageRepository)
    {
        $pages = $PageRepository->findAll();
        $page = $PageRepository->findOneBy(['slug' => $slug]);

        if ($page === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('main/page.html.twig',
            [
                'pages' => $pages,
                'page' => $page
            ]
        );
    }
}