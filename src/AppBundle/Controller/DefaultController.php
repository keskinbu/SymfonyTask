<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getManager()->getRepository('AppBundle:Post')->findAll();

        return $this->render(':default:index-post.html.twig', array('posts' => $posts));
    }
}
