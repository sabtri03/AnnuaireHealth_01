<?php

namespace App\Controller;

use App\Entity\Worker;
use App\Form\RegistrationFormType;
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
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, Mailer $mailer): Response
    {
        $worker = new Worker();
        $form = $this->createForm(RegistrationFormType::class, $worker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $worker->setPassword(
                $passwordEncoder->encodePassword(
                    $worker,
                    $form->get('password')->getData()
                )
            );
            $worker->setInscribeDate(new \DateTime());
            $worker->setBanned(0);
            $worker->setInscribe(1);
            $worker->setRoles(array('ROLE_WORKER'));
            $worker->setNbTry(0);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($worker);
            $entityManager->flush();

            // Send an email here via function profile_creation_email
            $mailer->sendMail('edit_profile', $worker->getEmail());

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
