<?php

namespace PolytechDashboard\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {
	public function indexAction() {
		/* appel du generateur de donn�es du controlleur */
		$noteController = $this->get ( 'noteController' );
		$myGrades = $noteController->indexAction ( 21303181, $this );
		$tacheController = $this->get ( 'tacheController' );
		$myTasks = $tacheController->indexAction ( 21303181, $this );
		$programmeController = $this->get ( 'coursController' );
		$myUE = $programmeController->indexAction ( 21303181, $this );
		$gestionnaireController = $this->get ( 'gestionnaireController' );
		$myAdmins = $gestionnaireController->indexAction ( 21303181, $this );
		
		return $this->render ( 'PolytechDashboardHomeBundle:Default:index.html.twig', array (
				'prenom' => 'Guillaume',
				'nom' => 'Blanchard',
				'id' => '21303181',
				'email' => 'guillaume.blanchard@u-psud.fr',
				'myGrades' => $myGrades,
				'myTasks' => $myTasks,
				'myUE' => $myUE,
				'myAdmins' => $myAdmins 
		) );
		
		// return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig', array('name' => $name));
	}
}
