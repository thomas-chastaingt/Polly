<?php

namespace App\Controller;

use App\Entity\Departments;
use App\Form\DepartmentsType;
use App\Repository\DepartmentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/departments")
 */
class DepartmentsController extends AbstractController
{
    /**
     * @Route("/", name="departments_index", methods={"GET"})
     */
    public function index(DepartmentsRepository $departmentsRepository): Response
    {
        return $this->render('departments/index.html.twig', [
            'departments' => $departmentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="departments_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $department = new Departments();
        $form = $this->createForm(DepartmentsType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($department);
            $entityManager->flush();

            return $this->redirectToRoute('departments_index');
        }

        return $this->render('departments/new.html.twig', [
            'department' => $department,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="departments_show", methods={"GET"})
     */
    public function show(Departments $department): Response
    {
        return $this->render('departments/show.html.twig', [
            'department' => $department,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="departments_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Departments $department): Response
    {
        $form = $this->createForm(DepartmentsType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('departments_index');
        }

        return $this->render('departments/edit.html.twig', [
            'department' => $department,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="departments_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Departments $department): Response
    {
        if ($this->isCsrfTokenValid('delete'.$department->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($department);
            $entityManager->flush();
        }

        return $this->redirectToRoute('departments_index');
    }
}
