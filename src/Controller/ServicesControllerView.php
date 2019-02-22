<?php

namespace App\Controller;

use App\Entity\Services;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ServicesControllerView extends AbstractController
{
    /**
     * @Route("/services1", name="services_all")
     */
    public function index(ServicesRepository $repository)
    {
        //$repository = $this->getDoctrine()
        //    ->getRepository(Services::class);
        $services = $repository->findAll();

        return $this->render('services1/index.html.twig', [
            'Services' => $services,
            'controller_name' => 'Services',
        ]);
    }

    //Just to take the list of services available
    public function listServicesMenu( ServicesRepository $repository)
    {

        $services = $repository->findAll();
        return $this->render('services1/listServices.html.twig', [
            'Services' => $services,
        ]);
    }

    /**
     * @Route("/services1/{id}", name="services_detail")
     */
    public function showService(Services $id){

        return $this->render(
            'services1/detail_services.html.twig',
            ['service'=>$id]
        );
    }
}