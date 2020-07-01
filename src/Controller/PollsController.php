<?php

namespace App\Controller;
use App\Entity\PollAnswers;
use App\Entity\Options;
use App\Form\OptionsType;
use App\Repository\OptionsRepository;
use App\Entity\Polls;
use App\Form\PollsType;
use App\Form\PollAnswersNewType;
use App\Form\PollsCreateType;
use App\Form\OptionsTypeNew;
use App\Repository\PollsRepository;
use App\Repository\PollAnswersRepository;
use App\Entity\Departments;
use App\Repository\DepartmentsRepository;
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
        if(!$this->isGranted('ROLE_MODERATOR') && !$this->isGranted('ROLE_ADMIN')){
            throw $this->createAccessDeniedException('not allowed because youre not mod or admin');
        }       
        return $this->render('polls/index.html.twig', [
            'polls' => $pollsRepository->findAll(),
        ]);
    }


     /**
     * @Route("/user", name="polls_user", methods={"GET"})
     */
    public function mypolls(PollsRepository $pollsRepository): Response
    {
        // deny access unless verified email
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_VERIFIED')) {
            $this->addFlash("warning", "You must verify your email.");
            return $this->redirectToRoute('app_login');
            }
        return $this->render('polls/mypolls.html.twig', [
            'polls' => $pollsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="polls_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        // deny access unless verified email
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_VERIFIED')) {
            $this->addFlash("warning", "You must verify your email.");
            return $this->redirectToRoute('app_login');
            }
        $poll = new Polls();
        $form = $this->createForm(PollsCreateType::class, $poll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           if($this->getUser()) {
                $entityManager = $this->getDoctrine()->getManager();
                $poll->setHide(0);
                $poll->setAuthor($this->getUser());
                $entityManager->persist($poll);
                $entityManager->flush();
            }

            return $this->redirectToRoute('options_new', ['id' => $poll->getId()]);
        }

        return $this->render('polls/new.html.twig', [
            'poll' => $poll,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/answers", name="answers_polls")
     */
    public function polls_answers(Polls $poll, OptionsRepository $optionsRepository, PollAnswersRepository $pollAnswersRepository, DepartmentsRepository $departmentsRepository, Request $request): Response
    {
        $pollAnswers = new PollAnswers();
        $pollAnswers->setPoll($poll);
        $form = $this->createForm(PollAnswersNewType::class, $pollAnswers);
        $form->handleRequest($request);

        
        $pollId =$poll->getId();
        $options = $optionsRepository->findByPolls($poll);
        $pollAnswersRepository = $pollAnswersRepository->findByPoll($poll);


        $numberAnswer = count($pollAnswersRepository);
        $array = [];
        $data = [];
        $arrayDepartment = [];
        $deptOrder = array();
            for($i=0; $i < $numberAnswer; $i++) {
                $departmentId = $pollAnswersRepository[$i]->getDepartment()->getId();
                array_push($arrayDepartment, $departmentId);
                
            }
            
           
            
            $sizeOfArrayDepartement = count($arrayDepartment);
            for ($k = 0; $k<$sizeOfArrayDepartement; $k++) {
                if(in_array($arrayDepartment[$k], $deptOrder, true)) {
                    
                }else {
                    array_push($deptOrder, $arrayDepartment[$k]);
                }
            }
         
            $numberOfdept = count($deptOrder);
            
            for($j=0; $j < $numberOfdept; $j++) {
                $idDept = $deptOrder[$j];
                $em = $this->getDoctrine()->getManager();
                //option la plus chois d'un sondage en fonction du département
                // $RAW_QUERY = "SELECT * FROM poll_answers WHERE poll_id = '".$pollId."' AND department_id = '".$idDept."' GROUP BY option_id 
                // HAVING COUNT(option_id)=(SELECT MAX(p.eff) FROM (SELECT option_id, COUNT(*) AS eff FROM poll_answers WHERE poll_id= '".$pollId."' 
                // AND `department_id`= '".$idDept."' GROUP BY option_id) AS p)";

                //option avec leurs effectifs dans un départment
                // $RAW_QUERY = "SELECT options.name AS 'OptionName', departments.name AS 'DepartmentName', COUNT(*) AS 'NumberOfTime' 
                // FROM poll_answers
                // LEFT JOIN options ON poll_answers.option_id = options.id
                // LEFT JOIN departments ON poll_answers.department_id = departments.id
                // WHERE poll_id='".$pollId."' 
                // AND department_id='".$idDept."' 
                // GROUP BY option_id";

                //effectif max
                // $RAW_QUERY = "SELECT MAX(p.eff) FROM (SELECT option_id,COUNT(*) AS eff FROM poll_answers 
                // WHERE poll_id='".$pollId."' AND `department_id`='".$idDept."' GROUP BY option_id) AS p";
                
                $RAW_QUERY = "SELECT departments.name, COUNT(*) AS 'NumberOfTime' 
                FROM poll_answers
                LEFT JOIN departments ON poll_answers.department_id = departments.id
                WHERE poll_id='".$pollId."' 
                AND department_id='".$idDept."' 
                ";

                $statement = $em->getConnection()->prepare($RAW_QUERY);
                $statement->execute();
                $result = $statement->fetchAll();
                array_push($array,$result);
            }



            $em2 = $this->getDoctrine()->getManager();
            $QUERY="SELECT poll_id, option_id, department_id, options.name AS 'NameOption', departments.name AS 'DepartmentName'
                    FROM poll_answers
                    LEFT JOIN options ON poll_answers.option_id = options.id
                    LEFT JOIN departments ON poll_answers.department_id = departments.id
                WHERE poll_id='".$pollId."' 
                
                ";
            $statement2 = $em2->getConnection()->prepare($QUERY);
            $statement2->execute();
            $result2 = $statement2->fetchAll();
            array_push($data,$result2);
            
        if ($form->isSubmitted() && $form->isValid()) {
           if($this->getUser()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($pollAnswers);
                $entityManager->flush();
            }

            return $this->redirectToRoute('trends');
        }
        
        return $this->render('polls/answers_polls.html.twig', [
            'options' => $options,
            'poll' => $poll,
            'pollAnswers' => $pollAnswers,
            'pollAnswers' => $pollAnswersRepository,
            'results' => $array,
            'datas' => $data,
            'numberOfDept' => $numberOfdept,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="polls_show", methods={"GET"})
     */
    public function show(Polls $poll): Response
    {
        // deny access unless verified email
         if (!$this->get('security.authorization_checker')->isGranted('ROLE_VERIFIED')) {
            $this->addFlash("warning", "You must verify your email.");
            return $this->redirectToRoute('app_login');
        }
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('polls/show.html.twig', [
            'poll' => $poll,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="polls_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Polls $poll): Response
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_VERIFIED')) {
            $this->addFlash("warning", "You must verify your email.");
            return $this->redirectToRoute('app_login');
            }
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $form = $this->createForm(PollsType::class, $poll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('polls_edit', ['id' => $poll->getId()]);
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
        // deny access unless admin role
         if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $this->addFlash("warning", "You must be admin.");
            return $this->redirectToRoute('app_login');
        }
        if ($this->isCsrfTokenValid('delete'.$poll->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($poll);
            $entityManager->flush();
        }

        return $this->redirectToRoute('polls_index');
    }

    /**
     * @Route("/{id}/options", name="poll_options", methods={"GET","POST"})
     */
    public function pollOptions(Request $request, Polls $poll, OptionsRepository $optionsRepository): Response
    {
        $option = new Options();
        $option->setPolls($poll);
        $form = $this->createForm(OptionsTypeNew::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($option);
            $entityManager->flush();

            return $this->redirectToRoute('poll_options', ['id' => $poll->getId()]);
        }
        return $this->render('polls/polls_options.html.twig', [
            'options' => $optionsRepository->findByPolls($poll),
            'poll' => $poll,
            'form' => $form->createView(),
            ]);
    }


    /**
     * @Route("/{id}/options/delete", name="poll_options_delete", methods={"DELETE"})
     */
    public function deletePollOptions(Request $request, Options $option): Response
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

        return $this->redirectToRoute('poll_options', ['id' => $option->getPolls()->getId()]);
    }
}