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
    public function index(PollsRepository $pollsRepository, PollAnswersRepository $pollAnswersRepository):Response
    {
        $polls = $pollsRepository->findBy([],['dateCreation' => 'DESC']);
       
        $stats = [];

        for ($i = 0; $i < count($polls); $i = $i+1) {
            $count = count($pollAnswersRepository->findByPoll($polls[$i]));

            $stats[] = [
                'count' => $count,
                'poll' => $polls[$i]
            ];

        }
        return $this->render('trends/index.html.twig', [
            'stats' => $stats
        ]);
    }
}
