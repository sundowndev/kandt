<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/{slug}", name="single_page")
     */
    public function page($slug)
    {
        $page = [];

        return $this->render('main/page.html.twig',
            ['page' => $page]
        );
    }
}