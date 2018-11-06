<?php

namespace App\Controller;

use App\Entity\ServiceUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServiceUserController extends AbstractController
{
    /**
     * @Route("/service/user", name="service_user")
     */
    public function index()
    {
        return $this->render('service_user/index.html.twig', [
            'controller_name' => 'ServiceUserController',
        ]);
    }
}
