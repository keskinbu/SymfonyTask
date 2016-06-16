<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login_route")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render(
            ':default:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        return $this->render(
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $user = new User();
                $mail = $request->get('mail');
                $plainTextPassword = $request->get('password');
                $username = $request->get('username');
                $password = $this->get('security.password_encoder')->encodePassword($user, $plainTextPassword);
                $user->setPassword($password);
                $user->setUsername($username);
                $user->setRole('ROLE_AUTHOR');
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($user);
                $manager->flush();
                return $this->render(':default:login.html.twig', array('error' => null, 'last_username' => $mail));
            } catch (\Exception $exc) {
                return $this->render(':default:register.html.twig', array('error' => true));
            }
        }

        return $this->render(':default:register.html.twig');
    }
}