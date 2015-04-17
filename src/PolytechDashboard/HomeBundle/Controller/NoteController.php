<?php

namespace PolytechDashboard\HomeBundle\Controller;

use PolytechDashboard\HomeBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends Controller {
	public static function indexAction($id, $controller) {
		//print_r ( "INSIDE" );
		
		$myGrades = [ ];
		/* liste de notes de l'etudiant */
		$tabNote = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Note' )->findByIdetudiant ( $id );
		if (! $tabNote) {
			return $myGrades;
		}
		/* nombre de notes de l'etudiant */
		$max = sizeof ( $tabNote );
		
		for($i = 0; $i < $max; $i ++) {
			$tmp = array ();
			
			$detailNote = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Detailnote' )->findById ( $tabNote [$i]->getIddetailnote() );
			$cours = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Cours' )->findById ( $detailNote [0]->getIdCours () );
			
			$tmp ['note'] = $tabNote [$i];
			$tmp ['detailNote'] = $detailNote [0];
			$tmp ['cours'] = $cours [0];
			
			/* ajout de la note a l'array */
			array_push ( $myGrades, $tmp );
			unset ( $tmp );
		}
		// print_r ( $myGrades );
		
		//print_r ( "INSIDE_END" );
		
		return $myGrades;
	}
}