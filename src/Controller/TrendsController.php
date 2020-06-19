<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrendsController extends AbstractController
{
    /**
     * @Route("/trends", name="trends")
     */
    public function index()
    {
        return $this->render('trends/index.html.twig', [
            'controller_name' => 'TrendsController',
        ]);
    }
}
