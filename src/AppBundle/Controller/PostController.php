<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 *
 * @Route("/post")
 */
class PostController extends Controller
{

    /**
     * @param Request $request
     *
     * @Route("/create", name="create_post")
     */
    public function createPostAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $post = new Post();
                $post->setTitle($request->get('title'));
                $post->setText($request->get('text'));
                $doSlug = str_replace(' ','-',$request->get('title'));
                $post->setSlug($doSlug);

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($post);
                $manager->flush();
                return $this->redirect($this->generateUrl('homepage'));
            } catch (\Exception $exc) {
                return $this->render(':default:create-post.html.twig', array('error' => true));
            }
        }
        return $this->render(':default:create-post.html.twig');
    }



    /**
     *
     * @Route("/view/{slug}", name="view_post")
     */
    public function viewPostAction($slug)
    {
        $post = $this->getDoctrine()->getManager()->getRepository('AppBundle:Post')->findOneBy(array('slug'=>$slug));

        return $this->render(':default:view-post.html.twig', array('post' => $post));

    }
}