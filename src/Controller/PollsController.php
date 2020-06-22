<?php

namespace App\Controller;

use App\Entity\Polls;
use App\Form\PollsType;
use App\Repository\PollsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/polls")
 */
class PollsController extends AbstractController
{
    /**
     * @Route("/", name="polls_index", methods={"GET"})
     */
    public function index(PollsRepository $pollsRepository): Response
    {
        return $this->render('polls/index.html.twig', [
            'polls' => $pollsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="polls_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $poll = new Polls();
        $form = $this->createForm(PollsType::class, $poll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($poll);
            $entityManager->flush();

            return $this->redirectToRoute('polls_index');
        }

        return $this->render('polls/new.html.twig', [
            'poll' => $poll,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="polls_show", methods={"GET"})
     */
    public function show(Polls $poll): Response
    {
        return $this->render('polls/show.html.twig', [
            'poll' => $poll,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="polls_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Polls $poll): Response
    {
        $form = $this->createForm(PollsType::class, $poll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('polls_index');
        }

        return $this->render('polls/edit.html.twig', [
            'poll' => $poll,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="polls_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Polls $poll): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poll->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($poll);
            $entityManager->flush();
        }

        return $this->redirectToRoute('polls_index');
    }
}
