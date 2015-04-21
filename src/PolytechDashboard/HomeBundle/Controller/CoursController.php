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
		$formation = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Etudiantformation' )->findByIdetudiant ( $id );

		$myUE = [ ];
		/* liste de notes de l'etudiant */
		$tabUE = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:UE' )->findByIdetudiant ($formation);
		if (! $tabUE) {
			throw $this->createNotFoundException ( 'Aucun cours trouvé pour cet étudiant' );
		}
		/* nombre de UE pour l'etudiant */
		$maxUE = sizeof ( $tabUE );
		
		for($i = 0; $i < $maxUE; $i ++) {
			$tmp = array ();
			$detailNote = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Detailnote' )->findById ( $tabNote [$i]->getIddetailnote() );
		}
			
		
		// return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig');
		// return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig', array('name' => $name));
		return $this->render ( 'PolytechDashboardHomeBundle:Default:index.html.twig', array (
				'cours' => $cours ) );
	}
}