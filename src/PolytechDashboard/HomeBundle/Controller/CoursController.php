<?php

namespace PolytechDashboard\HomeBundle\Controller;

use PolytechDashboard\HomeBundle\Entity\Cours;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoursController extends Controller {
	public function indexAction($id) {
		$cours = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Cours' )->find ( $id );
		
		if (! $cours) {
			throw $this->createNotFoundException ( 'Aucun cours trouvé pour cet id : ' . $id );
		}
		// return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig');
		// return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig', array('name' => $name));
		return $this->render ( 'PolytechDashboardHomeBundle:Default:index.html.twig', array (
				'cours' => $cours 
		) );
	}
}