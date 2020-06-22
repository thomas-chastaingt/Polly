<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PollsRepository;
use Symfony\Component\HttpFoundation\Response;

class TrendsController extends AbstractController
{
    /**
     * @Route("/trends", name="trends")
     */
    public function index(PollsRepository $pollsRepository):Response
    {
        return $this->render('trends/index.html.twig', [
            'polls' => $pollsRepository->findAll(),
        ]);
    }
}
