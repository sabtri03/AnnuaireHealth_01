<?php

namespace App\Controller;

use App\Repository\ServicesRepository;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="Search-Controller")
     */
    public function indexAction(Request $request)
    {
        //'AppBundle\Form\SearchType'
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        //if($form->isSubmitted() && $form->isValid()){
            //$search = $form['search']->getData();
            //return $this->redirectToRoute('search_result');
        //}

        return $this->render('search/form_searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }



    /**
     * @Route("/searchShow", name="search_result")
     *
     */
    public function searchAction(ServicesRepository $repository, Request $request)
    {
        //$name =  $request->get('search');
        //$name = $request->request->get('search');
        //$search = $request->query->get('search');
        $search = $request->query->get('search');

        $results = $repository->findByNom($search['search']);

        return $this->render(
            'search/index.html.twig',
            ['search' => $search['search'], 'results' => $results]
        );
    }
}
