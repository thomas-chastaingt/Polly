<?php

namespace App\Controller;

use App\Entity\Options;
use App\Form\OptionsType;
use App\Entity\Polls;
use App\Form\OptionsTypeNew;
use App\Repository\OptionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/options")
 */
class OptionsController extends AbstractController
{
    /**
     * @Route("/", name="options_index", methods={"GET"})
     */
    public function index(OptionsRepository $optionsRepository): Response
    {   // deny access unless admin role
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $this->addFlash("warning", "You must be admin to access this page.");
            return $this->redirectToRoute('app_login');
        }
        return $this->render('options/index.html.twig', [
            'options' => $optionsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/new", name="options_new", methods={"GET","POST"})
     */
    public function new(Polls $polls, Request $request): Response
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_VERIFIED')) {
            $this->addFlash("warning", "You must verify your email.");
            return $this->redirectToRoute('app_login');
            }
        $option = new Options();
        $option->setPolls($polls);
        $form = $this->createForm(OptionsTypeNew::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($option);
            $entityManager->flush();

            return $this->redirectToRoute('options_new', ['id' => $polls->getId()]);
        }

        return $this->render('options/new.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
            'poll' => $polls,
            'pollName' => $polls->getTitle(),
        ]);
    }

    

    /**
     * @Route("/{id}", name="options_show", methods={"GET"})
     */
    public function show(Options $option): Response
    {
        // deny access unless admin role
        //if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_VERIFIED')) {
            $this->addFlash("warning", "You must be admin to access this page.");
            return $this->redirectToRoute('app_login');
            }
        return $this->render('options/show.html.twig', [
            'option' => $option,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="options_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Options $option): Response
    {
        // deny access unless admin role
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_VERIFIED')) {
            $this->addFlash("warning", "You must be admin to access this page.");
            return $this->redirectToRoute('app_login');
            }
        
        $form = $this->createForm(OptionsType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('options_index');
        }

        return $this->render('options/edit.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="options_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Options $option): Response
    {
        // deny access unless admin role
        /*if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $this->addFlash("warning", "You must be admin to access this page.");
            return $this->redirectToRoute('app_login');
            }*/
        if ($this->isCsrfTokenValid('delete'.$option->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($option);
            $entityManager->flush();
        }

        return $this->redirectToRoute('options_new', ['id' => $option->getPolls()->getId()]);
    }
}
