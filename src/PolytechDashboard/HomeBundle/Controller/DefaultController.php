<?php

namespace PolytechDashboard\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {
	public function indexAction() {
		/* appel du generateur de note du controlleur */
		$noteController = $this->get ( 'noteController' );
		//print_r ( "BEFORE" );
		$myGrades = $noteController->indexAction ( 21303181, $this );
		//print_r ( "AFTER" );
		
		return $this->render ( 'PolytechDashboardHomeBundle:Default:index.html.twig', array (
				'prenom' => 'Guillaume',
				'nom' => 'Blanchard',
				'id' => '21303181',
				'myGrades' => $myGrades 
		) );
		
		// return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig', array('name' => $name));
	}
}
