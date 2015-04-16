<?php

namespace PolytechDashboard\HomeBundle\Controller;

use PolytechDashboard\HomeBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends Controller {
	public function indexAction($id) {
		$myGrades = [ ];
		/* liste de notes de l'etudiant */
		$tabNote = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Note' )->findByIdetudiant ( $id );
		if (! $tabNote) {
			throw $this->createNotFoundException ( 'Aucune Note trouvé pour cet id : ' . $id );
		}
		/* nombre de notes de l'étudiant */
		$max = sizeof ( $tabNote );
		
		for($i = 0; $i < $max; $i ++) {
			$tmp = array ();
			
			$detailNote = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Detailnote' )->findById ( $tabNote [$i]->getIdetudiant () );
			$cours = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Cours' )->findById ( $detailNote [0]->getId () );
			
			$tmp ['note'] = $tabNote [$i];
			$tmp ['detailNote'] = $detailNote [0];
			$tmp ['cours'] = $cours [0];
			
			/* ajout de la note a l'array */
			array_push ( $myGrades, $tmp );
			unset ( $tmp );
		}
		//print_r ( $myGrades );

		
		return $this->render ( 'PolytechDashboardHomeBundle:Default:index.html.twig', array (
				'myGrades' => $myGrades 
		) );
	}
}