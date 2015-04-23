<?php

namespace PolytechDashboard\HomeBundle\Controller;

use PolytechDashboard\HomeBundle\Entity\Tache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TacheController extends Controller {
	public static function indexAction($id, $controller) {
		$myTasksAdmin = [ ];
		$admins = [ ];
		$myTasksAuto = [ ];
		
		/* liste de taches de l'etudiant */
		$tabTasks = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tacheetudiant' )->findByIdetudiant ( $id );
		if ($tabTasks) {
			/* nombre de taches de l'etudiant */
			$max = sizeof ( $tabTasks );
			
			for($i = 0; $i < $max; $i ++) {
				$task = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tache' )->findOneById ( $tabTasks [$i]->getIdtache () );
				$admin = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $task->getIdgestionnaire () );
				
				if ($admin == null && $task->getIdetudiant () == $id) {
					/* tache auto attribuée */
					array_push ( $myTasksAuto, $task );
					// print_r("Tache auto_attribuée");
				} else {
					/* tache affectée par un gestionnaire */
					array_push ( $myTasksAdmin, $task );
					array_push ( $admins, $admin );
					// print_r("Tache Attribuée par un gestionnaire");
				}
				
				/* suppression des variables temporaires */
				unset ( $task );
				unset ( $admin );
			}
		}
		
		$result = array ();
		$result ['tasksAdmin'] = $myTasksAdmin;
		$result ['admins'] = $admins;
		$result ['tasksAuto'] = $myTasksAuto;
		return $result;
	}
}