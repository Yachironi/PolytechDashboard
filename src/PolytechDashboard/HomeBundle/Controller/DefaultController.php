<?php

namespace PolytechDashboard\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {
	public function indexAction() {
		/* appel du generateur de données du controlleur */
		$noteController = $this->get ( 'noteController' );
		$myGrades = $noteController->indexAction ( 21303181, $this );
		$tacheController = $this->get ( 'tacheController' );
		$myTasks = $tacheController->indexAction ( 21303181, $this );
		$programmeController = $this->get ( 'coursController' );
		$myUE = $programmeController->indexAction ( 21303181, $this );
		
		return $this->render ( 'PolytechDashboardHomeBundle:Default:index.html.twig', array (
				'prenom' => 'Guillaume',
				'nom' => 'Blanchard',
				'id' => '21303181',
				'myGrades' => $myGrades,
				'myTasks' => $myTasks,
				'myUE' => $myUE 
		) );
		
		// return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig', array('name' => $name));
	}
}
