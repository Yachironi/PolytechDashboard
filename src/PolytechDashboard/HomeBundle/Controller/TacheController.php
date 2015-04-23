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
		$adminsTaskSend = [];
		
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
		}
							
		/* liste des taches envoyées par l'étudiant*/
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
	public static function createTask($param) {
		$formType = isset ( $_POST ['gender'] ) ? mysql_real_escape_string ( $_POST ['gender'] ) : '';
		
		switch ($formType) {
			case "form1" :
				break;
			case "form2" :
				break;
			case "form3" :
				break;
			case "form4" :
				break;
			case "form5" :
				break;
			case "form6" :
				break;
			case "form7" :
				break;
			case "form8" :
				break;
			case "form9" :
				break;
		}
		return true;
	}
}