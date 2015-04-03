<?php

namespace PolytechDashboard\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig');
        //return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig', array('name' => $name));
    }
}
