<?php

namespace PolytechDashboard\HomeBundle\Controller;

use PolytechDashboard\HomeBundle\Entity\Cours;
use PolytechDashboard\HomeBundle\Entity\Etudiantformation;
use PolytechDashboard\HomeBundle\Entity\Etudiant;
use PolytechDashboard\HomeBundle\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoursController extends Controller {
	
	public function indexAction($id, $controller) {
		
		/* Formation l'etudiant */
		$formation = $controller->getDoctrine()->getRepository ( 'PolytechDashboardHomeBundle:Etudiantformation' )->findOneByIdetudiant ( $id );
		$myUE = [ ];
		/* liste de notes de l'etudiant */
		$tabUE = $controller->getDoctrine()->getRepository ( 'PolytechDashboardHomeBundle:UE' )->findByIdformation($formation->getIdformation());
		if (! $tabUE) {
			throw $this->createNotFoundException ( 'Aucun cours trouvé pour cet étudiant' );
		}
		/* nombre de UE pour l'etudiant */
		$maxUE = sizeof ( $tabUE );
		
		/* Boucle pour récupérer les cours */
		for($i = 0; $i < $maxUE; $i ++) {
			$tmp = array ();
			
			$cours = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Cours' )->findByIdue ( $tabUE [$i]->getId() );
			
			$tmp[ 'ue' ] = $tabUE[$i];
			$tmp[ 'cours' ] = $cours;
			
			array_push ( $myUE, $tmp );
			unset ( $tmp );
		}
		
		return $myUE;
	}
}