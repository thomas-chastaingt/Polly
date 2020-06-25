<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PollsRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PollAnswersRepository;

class TrendsController extends AbstractController



{
    /**
     * @Route("/trends", name="trends")
     */
   public function index(PollAnswersRepository $pollAnswersRepository):Response
    {
        $stats = $pollAnswersRepository->countByNumberAnswers();
        return $this->render('trends/index.html.twig', [
            'stats' => $stats
        ]);
    }
}
