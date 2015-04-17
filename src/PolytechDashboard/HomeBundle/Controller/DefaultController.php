<?php

namespace PolytechDashboard\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {
	public function indexAction() {
		$session = $this->getRequest ()->getSession ();
		// stocke un attribut pour une future requête
		$session->set ( 'idEtudiant', '1' );
		
		/* appel du generateur de note du controlleur */
		$noteController = $this->get ( 'noteController' );
		//print_r ( "BEFORE" );
		$myGrades = $noteController->indexAction ( 1, $this );
		//print_r ( "AFTER" );
		
		return $this->render ( 'PolytechDashboardHomeBundle:Default:index.html.twig', array (
				'prenom' => 'Guillaume',
				'nom' => 'Blanchard',
				'id' => '1',
				'myGrades' => $myGrades 
		) );
		
		// return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig', array('name' => $name));
	}
}
