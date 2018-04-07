<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Page;
use App\Repository\PageRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    public function __construct(PageRepository $PageRepository, \Twig_Environment $twig)
    {
        $pages = $PageRepository->findAll();

        $twig->addGlobal('pages', $pages);
    }

    /**
     * @Route("/", name="index")
     * @Method("GET")
     */
    public function index()
    {
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/page/{slug}", name="single_page")
     * @Method("GET")
     */
    public function page($slug, PageRepository $PageRepository)
    {
        $page = $PageRepository->findOneBy(['slug' => $slug]);

        if ($page === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('main/page.html.twig', [
                'page' => $page
            ]
        );
    }
}