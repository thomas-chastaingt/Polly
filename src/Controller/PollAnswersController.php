<?php

namespace App\Controller;

use App\Entity\PollAnswers;
use App\Form\PollAnswersType;
use App\Repository\PollAnswersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/poll/answers")
 */
class PollAnswersController extends AbstractController
{
    /**
     * @Route("/", name="poll_answers_index", methods={"GET"})
     */
    public function index(PollAnswersRepository $pollAnswersRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('poll_answers/index.html.twig', [
            'poll_answers' => $pollAnswersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="poll_answers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $pollAnswer = new PollAnswers();
        $form = $this->createForm(PollAnswersType::class, $pollAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pollAnswer);
            $entityManager->flush();

            return $this->redirectToRoute('poll_answers_index');
        }

        return $this->render('poll_answers/new.html.twig', [
            'poll_answer' => $pollAnswer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="poll_answers_show", methods={"GET"})
     */
    public function show(PollAnswers $pollAnswer): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');


        return $this->render('poll_answers/show.html.twig', [
            'poll_answer' => $pollAnswer,
        ]);
    }

    // /**
    //  * @Route("/{id}/edit", name="poll_answers_edit", methods={"GET","POST"})
    //  */
    // public function edit(Request $request, PollAnswers $pollAnswer): Response
    // {
    //     $form = $this->createForm(PollAnswersType::class, $pollAnswer);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('poll_answers_index');
    //     }

    //     return $this->render('poll_answers/edit.html.twig', [
    //         'poll_answer' => $pollAnswer,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="poll_answers_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, PollAnswers $pollAnswer): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$pollAnswer->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($pollAnswer);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('poll_answers_index');
    // }
}
