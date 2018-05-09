<?php

namespace App\Controller;

use App\Entity\Page;
use App\Form\PageType;
use App\Repository\PageRepository;
use App\Utils\Slugger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/admin/pages", name="page_")
 */
class PageController extends Controller
{
    /**
     * List all pages
     *
     * @Route("/", name="index", methods="GET")
     */
    public function index(PageRepository $pageRepository): Response
    {
        return $this->render('admin/page/index.html.twig', [
                'pages' => $pageRepository->findBy([], ['id' => 'desc'])
            ]
        );
    }

    /**
     * Create a new page
     *
     * @Route("/new", name="new", methods="GET|POST")
     */
    public function new(Request $request, ValidatorInterface $validator): Response
    {
        $page = new Page();
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $page->setSlug(Slugger::slugify($page->getTitle()));
            $page->setAuthorId(1);
            $page->setImgSrc('mdr');

            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('page_index');
        }

        return $this->render('admin/page/new.html.twig', [
            'page' => $page,
            'form' => $form->createView(),
            'messages' => $form->getErrors(true),
        ]);
    }

    /**
     * Edit a page
     *
     * @Route("/{id}/edit", name="edit", methods="GET|POST")
     */
    public function edit(Request $request, Page $page): Response
    {
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('page_edit', ['id' => $page->getId()]);
        }

        return $this->render('admin/page/edit.html.twig', [
            'page' => $page,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Delete a page
     *
     * @Route("/{id}", name="delete", methods="DELETE")
     */
    public function delete(Request $request, Page $page): Response
    {
        if ($this->isCsrfTokenValid('delete'.$page->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();
        }

        return $this->redirectToRoute('page_index');
    }
}
