<?php

namespace App\Controller;

use App\Entity\Worker;
use App\Form\RegistrationFormType;
use App\Repository\WorkerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WorkerController extends AbstractController
{
    /**
     * @Route("/worker", name="worker")
     */
    public function index (WorkerRepository $repository)
    {
        //$repository = $this->getDoctrine()
        //    ->getRepository(Services::class);
        $worker = $repository->findAll();

        return $this->render('worker/index.html.twig', [
            'Workers' => $worker,
            'controller_name' => 'Worker',
        ]);
    }

    /**
     * @Route("/worker/{id}", name="worker_detail")
     */
    public function showWorker(Worker $id){

        return $this->render(
            'worker/detail_worker.html.twig',
            ['worker'=>$id,]
        );
    }


}
