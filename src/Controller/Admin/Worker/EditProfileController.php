<?php

namespace App\Controller\Admin\Worker;

use App\Entity\Worker;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditProfileController extends AbstractController
{
    /**
     * @Route("admin/worker/acces_profile", name="edit_profile_worker")
     */
    public function index()
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user*/
        $user = $this->getUser();
        $user_id = $user->getId();
        $worker = $this->getDoctrine()->getRepository(Worker::class)->find($user_id);

        // Call whatever methods you've added to your User class
        // For example, if you added a getFirstName() method, you can use that.
        return $this->render('admin/worker/index.html.twig', [
            'user' => $user,
            'worker' => $worker,
        ]);
    }


    /**
     * @Route("admin/worker/profile", name="worker_profile_edit")
     */
    public function editWorkerProfile( Request $request, EntityManagerInterface $em) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        /** @var \App\Entity\User $user*/
        $user = $this->getUser();
        $user_id = $user->getId();
        $worker = $this->getDoctrine()->getRepository(Worker::class)->find($user_id);


        $form = $this->createForm(RegistrationFormType::class, $worker);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($worker);
            $em->flush();

            $parameters['id'] = $worker->getId();
            return $this->redirectToRoute('worker_detail',  $parameters);
        }

        return $this->render('admin/worker/editProfile.html.twig', [
            'registrationForm' => $form->createView(),
            'worker' => $worker,
        ]);
    }





}
