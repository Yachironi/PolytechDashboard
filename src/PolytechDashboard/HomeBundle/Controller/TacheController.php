<?php

namespace PolytechDashboard\HomeBundle\Controller;

use PolytechDashboard\HomeBundle\Entity\Tache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TacheController extends Controller {
	public static function indexAction($id, $controller) {
		$myTasksReceived = [ ];
		$myTasksSend = [ ];
		$admins = [ ];
		$adminsTaskSend = [ ];
		
		/* liste de taches affectées a l'etudiant */
		$tabTasks = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tacheetudiant' )->findByIdetudiant ( $id );
		if ($tabTasks) {
			/* nombre de taches de l'etudiant */
			$max = sizeof ( $tabTasks );
			
			for($i = 0; $i < $max; $i ++) {
				$task = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tache' )->findOneById ( $tabTasks [$i]->getIdtache () );
				$admin = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $task->getIdgestionnaire () );
				
				if ($admin != null) {
					/* tache affectée par un gestionnaire */
					array_push ( $admins, $admin );
				}
				array_push ( $myTasksReceived, $task );
				
				/* suppression des variables temporaires */
				unset ( $task );
				unset ( $admin );
			}
			usort ( $myTasksReceived, function ($a, $b) {
				return ($a->getDatefin () < $b->getDatefin ()) ? - 1 : 1;
			} );
		}
		
		/* liste des taches envoyées par l'étudiant */
		$tabTasksSend = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tachegestionnaire' )->findByIdetudiant ( $id );
		if ($tabTasksSend) {
			/* nombre de taches que l'etudiant a envoyé */
			$max = sizeof ( $tabTasksSend );
			
			for($i = 0; $i < $max; $i ++) {
				$task = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tache' )->findOneById ( $tabTasksSend [$i]->getIdtache () );
				$admin = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $tabTasksSend [$i]->getIdgestionnaire () );
				
				/* tache affectée a un gestionnaire */
				array_push ( $adminsTaskSend, $admin );
				
				array_push ( $myTasksSend, $task );
				
				/* suppression des variables temporaires */
				unset ( $task );
				unset ( $admin );
			}
		}
		
		$result = array ();
		$result ['tasksReceived'] = $myTasksReceived;
		$result ['admins'] = $admins;
		$result ['tasksSend'] = $myTasksSend;
		$result ['adminsTaskSend'] = $adminsTaskSend;
		return $result;
	}
	
	public function submitFormAction(Request $request) {
		if ($request->getMethod () == 'POST') {
			$typeForm = substr ( $request->get ( 'list_form' ), - 1 );
			
			$destinataire = $request->get ( 'destinataire_form' . $typeForm );
			$objet = $request->get ( 'objet_form' . $typeForm );
			
			/* TODO Importance */
			// $importance =
			
			switch ($typeForm) {
				case 2 :
					/* durée */
					$duree = $request->get ( 'duree_absence' );
					
					/* motif */
					$duree = $request->get ( 'motif_justification_absence' );
					
					/* fichier */
					$file = $request->get ( 'absence_InputFile' );
					
					/* échéance */
					if ($request->get ( 'checkbox_form2' ) == true) {
						$echeance = $request->get ( 'echeance_form2' );
					}
					
					break;
				case 3 :
					/* date et heure du RDV */
					$duree = $request->get ( 'date_rdv' );
					
					/* motif */
					$duree = $request->get ( 'motif_rdv' );
					
					/* échéance */
					if ($request->get ( 'checkbox_form3' ) == true) {
						$echeance = $request->get ( 'echeance_form3' );
					}
					
					break;
				case 4:
					/* type du devoir rendu */
					$type = $request->get ( 'list_devoirs' );
					
					/* nom du devoir */
					$nom = $request->get ( 'objet_form4' );
					
					/* fichier */
					$file = $request->get ( 'renduDevoir_InputFile' );
					
					/* commentaire */
					$commentaire = $request->get ( 'commentaire_rendu_devoir' );
					
					break;				
				case 5:
					/* type d'inscritpion*/
					$typeForm = $request->get ( 'list_inscription' );
					
					/* motif */
					$duree = $request->get ( 'motif_inscription' );
					
					/* fichier */
					$file = $request->get ( 'inscription_InputFile' );
					
					/* échéance */
					if ($request->get ( 'checkbox_form5' ) == true) {
						$echeance = $request->get ( 'echeance_form5' );
					}
					
					break;			
				case 6:
					/* dates de stage */
					$dates_stage = $request->get ( 'dates_stage' );
					
					/* détail */
					$detail = $request->get ( 'detail_stage' );
					
					/* fichier */
					$file = $request->get ( 'validStage_InputFile' );
					
					/* échéance */
					if ($request->get ( 'checkbox_form6' ) == true) {
						$echeance = $request->get ( 'echeance_form6' );
					}
					
					break;				
				case 7:	
					/* remarque*/
					$remarque_stage = $request->get ( 'remarque_stage' );
					
					/* fichier */
					$file = $request->get ( 'pdf_convention_InputFile' );
					
					/* échéance */
					if ($request->get ( 'checkbox_form7' ) == true) {
						$echeance = $request->get ( 'echeance_form7' );
					}
					
					break;
				case 8 :
					/* text */
					$text = $request->get ( 'texte_form8' );
					
					/* fichier */
					$file = $request->get ( 'taskPerso_InputFile' );
					
					/* échéance */
					if ($request->get ( 'checkbox_for8' ) == true) {
						$echeance = $request->get ( 'echeance_form8' );
					}
					
					break;				
				case 9 :
					/* text */
					$text = $request->get ( 'text_autre_demande' );
					
					/* fichier */
					$file = $request->get ( 'demandeNonRepertoriee_InputFile' );

					/* échéance */
					if ($request->get ( 'checkbox_form6' ) == true) {
						$echeance = $request->get ( 'echeance_form6' );
					}

					break;				
			}
			
			
		}
	}
}