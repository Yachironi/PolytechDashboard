<?php

namespace PolytechDashboard\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PolytechDashboard\HomeBundle\Entity\Gestionnaire;

class GestionnaireController extends Controller {
	public function indexAction($id, $controller) {
		
		/* Formation l'etudiant */
		$formation = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Etudiantformation' )->findOneByIdetudiant ( $id );
		$myGestionnaires = [ ];
		
		/* Gestionnaires associ�s a l'etudiant */
		$GestionnaireAdmin = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:GestionnaireAdmin' )->findOneByIdformation ( $formation->getIdformation () );
		if ($GestionnaireAdmin != null) {
			$admin = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $GestionnaireAdmin->getIdgestionnaire () );
		} else {
			print_r ( "GestionnaireAdmin manquant en BDD pour la formation suivante : " + $formation );
		}
		
		$GestionnaireStage = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:GestionnaireStage' )->findOneByIdformation ( $formation->getIdformation () );
		if ($GestionnaireStage != null) {
			$stage = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $GestionnaireStage->getIdgestionnaire () );
		} else {
			print_r ( "GestionnaireStage manquant en BDD pour la formation suivante : " + $formation );
		}
		
		$GestionnaireFormation = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:GestionnaireFormation' )->findOneByIdformation ( $formation->getIdformation () );
		if ($GestionnaireFormation != null) {
			$Gestionnairef = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $GestionnaireFormation->getIdgestionnaire () );
		} else {
			print_r ( "GestionnaireFormation manquant en BDD pour la formation suivante : " + $formation );
		}
		$cours = [ ];
		
		/* Liste des Gestionnaires de cours associ�s a l'etudiant */
		$tabCours = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Cours' )->findByIdformation ( $formation->getIdformation () );
		if (! $tabCours) {
			throw $this->createNotFoundException ( 'Aucun cours trouv� pour cet �tudiant' );
		}
		/* nombre de cours pour l'etudiant */
		$maxCours = sizeof ( $tabCours );
		
		// print_r("Nombre de cours : ".$maxCours."\n");
		/* Boucle pour r�cup�rer les gestionnaires */
		for($i = 0; $i < $maxCours; $i ++) {
			
			$tmp = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:GestionnaireCours' )->findOneByIdcours ( $tabCours [$i]->getId () );
			$gestionnaireC = new Gestionnaire ();
			
			if ($tmp != null) {
				/* gestionnaire de cours trouv� */
				$gestionnaireC = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $tmp->getIdgestionnaire () );
			}
			
			array_push ( $cours, $gestionnaireC );
			unset ( $gestionnaireC );
			unset ( $tmp );
		}
		
		$myGestionnaires ['Admin'] = $admin;
		$myGestionnaires ['Stage'] = $stage;
		$myGestionnaires ['Formation'] = $Gestionnairef;
		$myGestionnaires ['Cours'] = $cours;
		
		return $myGestionnaires;
	}
}