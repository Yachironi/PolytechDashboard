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
		
		/* liste de taches affect�es a l'etudiant */
		$tabTasks = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tacheetudiant' )->findByIdetudiant ( $id );
		if ($tabTasks) {
			/* nombre de taches de l'etudiant */
			$max = sizeof ( $tabTasks );
			
			for($i = 0; $i < $max; $i ++) {
				$task = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tache' )->findOneById ( $tabTasks [$i]->getIdtache () );
				$admin = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $task->getIdgestionnaire () );
				
				if ($admin != null) {
					/* tache affect�e par un gestionnaire */
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
		
		/* liste des taches envoy�es par l'�tudiant */
		$tabTasksSend = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tachegestionnaire' )->findByIdetudiant ( $id );
		if ($tabTasksSend) {
			/* nombre de taches que l'etudiant a envoy� */
			$max = sizeof ( $tabTasksSend );
			
			for($i = 0; $i < $max; $i ++) {
				$task = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tache' )->findOneById ( $tabTasksSend [$i]->getIdtache () );
				$admin = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $tabTasksSend [$i]->getIdgestionnaire () );
				
				/* tache affect�e a un gestionnaire */
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
			$typeForm = substr($request->get ( 'list_form' ),-1);
			
			$destinataire = $request->get ( 'destinataire_form'.$typeForm );
			$objet = $request->get ( 'objet_form'.$typeForm );
			/* TODO Importance*/				
			switch ($typeForm){
				case 2 : case 3 :
					/* dur�e */
					
					/* �ch�ance */
					break;
				case 4:
					/* type du devoir rendu */
					
					/* nom du devoir */
				
					/* commentaire */
				case 5:
					/* type d'inscritpion*/
					$typeForm = $request->get ( 'list_inscription' );
					/* switch/case TOEIC/Bourse/M2R/Sport/Polytech */
					
					/* motif */
					
					/* pi�ce jointe */
				case 6:
					/* dur�e du stage */
					
					/* �ch�ance optionelle */
				case 7:	
					/* remarque*/
					
					/* fichier */
					
					/* �ch�ance */
					
				case 8:
					/* text */
					
					/* fichier */
					
					/* �ch�ance */
			}
		}
	}
}