<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmationController extends AbstractController
{
    /**
     * @Route("/confirmation", name="confirmation")
     */
    public function index()
    {
         // deny access unless verified email
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_VERIFIED')) {
            $this->addFlash("warning", "You must verify your email.");
            return $this->redirectToRoute('app_login');
        }
        return $this->render('confirmation/index.html.twig', [
            'controller_name' => 'ConfirmationController',
        ]);
    }
}
