<?php

namespace App\Controller;
use App\Entity\Polls;
use App\Entity\PollAnswers;
use App\Form\PollAnswersType;
use App\Form\PollAnswersTypeNew;
use App\Repository\PollAnswersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OptionsRepository;
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
        // deny access unless admin role
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $this->addFlash("warning", "You must be admin to access this page.");
            return $this->redirectToRoute('app_login');
        }
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('poll_answers/index.html.twig', [
            'poll_answers' => $pollAnswersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/new", name="poll_answers_new", methods={"GET","POST"})
     */
    public function new(Polls $poll, Request $request): Response
    {
        $pollAnswer = new PollAnswers();
        $pollAnswer->setPoll($poll);
        $form = $this->createForm(PollAnswersTypeNew::class, $pollAnswer);
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
        // deny access unless admin role
         if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $this->addFlash("warning", "You must be admin to access this page.");
            return $this->redirectToRoute('app_login');
        }
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('poll_answers/show.html.twig', [
            'poll_answer' => $pollAnswer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="poll_answers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PollAnswers $pollAnswer): Response
    {
        // deny access unless admin role
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $this->addFlash("warning", "You must be admin to access this page.");
            return $this->redirectToRoute('app_login');
        }
        $form = $this->createForm(PollAnswersType::class, $pollAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('poll_answers_index');
        }

        return $this->render('poll_answers/edit.html.twig', [
            'poll_answer' => $pollAnswer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="poll_answers_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PollAnswers $pollAnswer): Response
    {
        // deny access unless admin role
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $this->addFlash("warning", "You must be admin to access this page.");
            return $this->redirectToRoute('app_login');
        }
        if ($this->isCsrfTokenValid('delete'.$pollAnswer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pollAnswer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('poll_answers_index');
    }
}
