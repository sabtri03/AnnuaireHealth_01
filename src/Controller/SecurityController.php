<?php

namespace App\Controller;

use App\Entity\Pictures;
use App\Entity\ServiceUser;
use App\Entity\Worker;
use App\Form\RegistrationFormType;
use App\Form\RegistrationServiceUserType;
use App\Services\Mailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register()
    {

            return $this->render('registration/register.html.twig', [
                'controller_name' => 'RegisterControlleur',
            ]);
    }


    /**
     * @Route("/register/Worker", name="app_register_worker")
     */
    public function registerWorker(Request $request, UserPasswordEncoderInterface $passwordEncoder, Mailer $mailer): Response
    {
        $worker = new Worker();
        $form = $this->createForm(RegistrationFormType::class, $worker, array('attr' => array('class' => 'contact-form')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $worker->setPassword(
                $passwordEncoder->encodePassword(
                    $worker,
                    $form->get('password')->getData()
                )
            );
            // fill in the time , user group and other data
            $worker->setInscribeDate(new \DateTime());
            $worker->setBanned(0);
            $worker->setInscribe(1);
            $worker->setRoles(array('ROLE_WORKER'));
            $worker->setNbTry(0);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($worker);
            $entityManager->flush();

            // dump($worker->getLogo()); die();
            // Send an email here via service Mailer
            $mailer->sendMail('edit_profile', $worker->getEmail());

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/registerWorker.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/ServiceUser", name="app_register_serviceUser")
     */
    public function registerServiceUser(Request $request, UserPasswordEncoderInterface $passwordEncoder, Mailer $mailer): Response
    {
        $serviceUser = new ServiceUser();
        $form = $this->createForm(RegistrationServiceUserType::class, $serviceUser, array('attr' => array('class' => 'contact-form')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $serviceUser->setPassword(
                $passwordEncoder->encodePassword(
                    $serviceUser,
                    $form->get('password')->getData()
                )
            );
            // fill in the time , user group and other data
            $serviceUser->setInscribeDate(new \DateTime());
            $serviceUser->setBanned(0);
            $serviceUser->setInscribe(1);
            $serviceUser->setRoles(array('ROLE_USER'));
            $serviceUser->setNbTry(0);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($serviceUser);
            $entityManager->flush();

            // dump($serviceUser->getLogo()); die();
            // Send an email here via service Mailer
            $mailer->sendMail('edit_profile', $serviceUser->getEmail());

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/registrationServiceUser.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
