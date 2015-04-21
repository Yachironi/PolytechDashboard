<?php

namespace PolytechDashboard\HomeBundle\Controller;

use PolytechDashboard\HomeBundle\Entity\Tache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TacheController extends Controller {
	public static function indexAction($id, $controller) {
		$myTasks = [ ];
		$admins = [ ];
		/* liste de taches de l'etudiant */
		$tabTasks = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tacheetudiant' )->findByIdetudiant ( $id );
		if (! $tabTasks) {
			return $myTasks;
		}
		/* nombre de taches de l'etudiant */
		$max = sizeof ( $tabTasks );		
		
		for($i = 0; $i < $max; $i ++) {			
			$task = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Tache' )->findOneById ( $tabTasks [$i]->getIdtache () );
			$admin = $controller->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Gestionnaire' )->findOneById ( $task->getIdgestionnaire () );
				
			/* ajout de la tache a l'array */
			array_push ( $myTasks, $task );
			array_push ( $admins, $admin );
			
			/* suppression des variables temporaires */
			unset ( $task );
			unset ( $admin );
		}
		$result = array();
		$result['tasks'] = $myTasks;
		$result['admins'] = $admins;
		return $result;
	}
}