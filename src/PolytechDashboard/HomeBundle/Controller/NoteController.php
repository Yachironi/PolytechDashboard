<?php

namespace PolytechDashboard\HomeBundle\Controller;

use PolytechDashboard\HomeBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends Controller {
	public function indexAction($id) {
		$result = [];
		
		/* liste de notes de l'etudiant */
		$tabNote = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Note' )->findByIdEtudiant ( $id );
		if (! $tabNote) {
			throw $this->createNotFoundException ( 'Aucune Note trouvé pour cet id : ' . $id );
		}
		
		$max = sizeof ( $tabNote );
		for($i = 0; $i < $max; $i ++) {
			$detailNote = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:DetailNote' )->findById($tabNote[i].id);
			$cours = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Cours' )->findById($detailNote.id);
			array_push($result,$cours.nomMatiere,$detailNote.detail,$tabNote[i].moyenne,$cours.coefficient,$detailNote.pourcentage);
		}
				
		return $this->render ( 'PolytechDashboardHomeBundle:Default:index.html.twig', array (
				'Result' => $result 
		) );
	}
}