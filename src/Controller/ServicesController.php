<?php

namespace App\Controller;

use App\Entity\Services;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ServicesController extends AbstractController
{
    /**
     * @Route("/services", name="services_all")
     */
    public function index( ServicesRepository $repository)
    {
        //$repository = $this->getDoctrine()
        //    ->getRepository(Services::class);
        $services = $repository->findAll();

        return $this->render('services/index.html.twig', [
            'Services' => $services,
            'controller_name' => 'Services',
        ]);
    }

    //Just to take the list of services available
    public function listServicesMenu( ServicesRepository $repository)
    {

        $services = $repository->findAll();
        return $this->render('services/listServices.html.twig', [
            'Services' => $services,
        ]);
    }

    /**
     * @Route("/services/{id}", name="services_detail")
     */
    public function showService(Services $id){

        return $this->render(
            'services/detail_services.html.twig',
            ['service'=>$id]
        );
    }
}