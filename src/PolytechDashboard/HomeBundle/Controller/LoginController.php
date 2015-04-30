<?php

namespace PolytechDashboard\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PolytechDashboard\HomeBundle\Entity\Etudiant;
use PolytechDashboard\HomeBundle\Modals\Login;

class LoginController extends Controller {
	public function indexAction(Request $request) {
		$session = $this->getRequest ()->getSession ();
		$em = $this->getDoctrine ()->getEntityManager ();
		$repository = $em->getRepository ( 'PolytechDashboardHomeBundle:Etudiant' );
		
		if ($request->getMethod () == 'POST') {
			
			$session->clear ();
			$username = $request->get ( 'username' );
			$passwordBeforeHash = $request->get ( 'password' );
			$password = sha1 ( $passwordBeforeHash );
			$remember = $request->get ( 'remember' );
			$user = $repository->findOneBy ( array (
					'email' => $username,
					'password' => $password 
			) );
			
			/* appel du generateur de donn�es du controlleur */
			$noteController = $this->get ( 'noteController' );
			$myGrades = $noteController->indexAction ( $user, $this );
			$tacheController = $this->get ( 'tacheController' );
			$myTasks = $tacheController->indexAction ( $user, $this );
			$programmeController = $this->get ( 'coursController' );
			$myUE = $programmeController->indexAction ( $user, $this );
			$gestionnaireController = $this->get ( 'gestionnaireController' );
			$myAdmins = $gestionnaireController->indexAction ( 21303181, $this );
			$myEvent = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:Evenement' )->findAll();
			$myNews = $this->getDoctrine ()->getRepository ( 'PolytechDashboardHomeBundle:News' )->findAll();
			usort ( $myEvent , function ($a, $b) {
				return ($a->getDateEvenement() < $b->getDateEvenement()) ? - 1 : 1;
			} );
			usort ( $myNews, function ($a, $b) {
				return ($a->getDateAjout () < $b->getDateAjout ()) ? - 1 : 1;
			} );
			
			if ($user) {
                $loginTMP = new Login ();
                $loginTMP->setUsername ( $username );
                $loginTMP->setPassword ( $password );
                $loginTMP->setId($user->getId());
                $session->set ( 'loginTMP', $loginTMP );
				if ($remember == 'remember-me') {
					$login = new Login ();
					$login->setUsername ( $username );
					$login->setPassword ( $password );
                    $login->setId($user->getId());
					$session->set ( 'login', $login );
				}
				return $this->render ( 'PolytechDashboardHomeBundle:Default:index.html.twig', array (
						'prenom' => $user->getPrenom (),
						'nom' => $user->getNom (),
						'email' => $user->getEmail (),
						'id' => $user->getId(),
						'myGrades' => $myGrades,
						'myTasks' => $myTasks,
						'myUE' => $myUE,
						'myAdmins' => $myAdmins, 
						'myNews' => $myNews,
						'myEvent' => $myEvent
				) );
			} else {
				return $this->render ( 'PolytechDashboardHomeBundle:Default:login.html.twig', array (
						'name' => 'Login Error' 
				) );
			}
		} /*
		   * else {
		   * if ($session->has('login')) {
		   * $login = $session->get('login');
		   * $username = $login->getUsername();
		   * $password = $login->getPassword();
		   * $user = $repository->findOneBy(array('email' => $username, 'password' => $password));
		   *
		   * /* appel du generateur de note du controlleur
		   * $noteController = $this->get ( 'noteController' );
		   * $myGrades = $noteController->indexAction ( $user, $this );
		   * if ($user) {
		   * return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig', array('prenom' => $user->getPrenom(),'nom' => $user->getNom(),'id' => $user, 'myGrades' => $myGrades, 'myTasks' => $myTasks, 'myUE' => $myUE ));
		   * }
		   * }
		   * return $this->render('PolytechDashboardHomeBundle:Default:login.html.twig');
		   * }
		   */
		return $this->render ( 'PolytechDashboardHomeBundle:Default:login.html.twig' );
	}
	public function logoutAction(Request $request) {
		$session = $this->getRequest ()->getSession ();
		$session->clear ();
		return $this->render ( 'PolytechDashboardHomeBundle:Default:login.html.twig' );
	}
}
