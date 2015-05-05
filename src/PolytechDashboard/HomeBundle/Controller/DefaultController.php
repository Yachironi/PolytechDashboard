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
		$myEvent = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Evenement' )->findAll();
		$myNews = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:News' )->findAll();
		$myStatueTask = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tacheetudiant' )->findByIdetudiant ( 21303181 );
		
		usort ( $myEvent , function ($a, $b) {
			return ($a->getDateEvenement() < $b->getDateEvenement()) ? - 1 : 1;
		} );
		usort ( $myNews, function ($a, $b) {
			return ($a->getDateAjout () < $b->getDateAjout ()) ? - 1 : 1;
		} );
		$formation = $this->getDoctrine()->getRepository ( 'PolytechDashboardHomeBundle:Formation' )->findOneById ( 41 );
			
		return $this->render ( 'PolytechDashboardHomeBundle:Default:index.html.twig', array (
				'prenom' => 'Guillaume',
				'nom' => 'Blanchard',
				'id' => '21303181',
				'email' => 'guillaume.blanchard@u-psud.fr',
				'telephone' => '0601020304',
				'formation' => $formation,
				'myGrades' => $myGrades,
				'myTasks' => $myTasks,
				'myUE' => $myUE,
				'myAdmins' => $myAdmins,
				'myNews' => $myNews,
				'myEvent' => $myEvent,
				'myStatueTask' => $myStatueTask 
		) );
		
		// return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig', array('name' => $name));
	}
}
