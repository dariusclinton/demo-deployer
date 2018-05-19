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
        // // replace this example code with whatever you need
        // return $this->render('default/index.html.twig', array(
        //     'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        // ));
        

        return $this->render('AppBundle:Default:index.html.twig');
    }


     /**
     * @Route("/banque/list", name="app_banque_list")
     */
    public function listBanqueAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Banque');
        $banques = $repo->findAll();

        $parameters = array(
            'banques' => $banques
        );

        return $this->render('AppBundle:Default:banque-list.html.twig', $parameters);
    }
}
