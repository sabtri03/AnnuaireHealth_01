<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServicesType;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/services")
 */
class ServicesController extends AbstractController
{
    /**
     * @Route("/", name="services_index", methods={"GET"})  //"services_index" "services_all"
     */
    public function index(ServicesRepository $servicesRepository): Response
    {
        return $this->render('services/index.html.twig', [
            'services' => $servicesRepository->findAll(),
            'controller_name' => 'Services',
        ]);
    }

    /*******Sab****/
    //Just to take the list of services available
    public function listServicesMenu( ServicesRepository $repository)
    {

        $services = $repository->findAll();
        return $this->render('services/listServices.html.twig', [
            'Services' => $services,
        ]);
    }

/*******Sab****/
    /**
     * @Route("/services/{id}", name="services_detail")
     */
    public function showService(Services $id){

        return $this->render(
            'services1/detail_services.html.twig',
            ['service'=>$id]
        );
    }

    /**
     * @Route("/new", name="services_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $service = new Services();
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('services_index');
        }

        return $this->render('services/new.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="services_show", methods={"GET"})
     */
    public function show(Services $service): Response
    {
        return $this->render('services/show.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="services_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Services $service): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('services_index', [
                'id' => $service->getId(),
            ]);
        }

        return $this->render('services/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="services_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Services $service): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('services_index');
    }
}
