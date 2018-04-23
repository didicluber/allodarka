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
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * Lists all categorie entities.
     *
     * @Route("/", name="homepage")
     *
     */
    public function catAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AppBundle:Categorie')->findAll();
        $films = $em->getRepository('AppBundle:Film')->findAll();
//        $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
//        $path = $helper->asset($films, 'imageFile');
        return $this->render(':default:index.html.twig', array(
            'categories' => $categories,
            'films' => $films,
        ));
    }



}
