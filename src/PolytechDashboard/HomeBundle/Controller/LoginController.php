<?php
namespace PolytechDashboard\HomeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PolytechDashboard\HomeBundle\Entity\Etudiant;
use PolytechDashboard\HomeBundle\Modals\Login;

class LoginController extends Controller {

    public function indexAction(Request $request) {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('PolytechDashboardHomeBundle:Etudiant');
       
        if ($request->getMethod() == 'POST') {
            
        	$session->clear();
            $username = $request->get('username');
            $passwordBeforeHash = $request->get('password');
            $password = sha1($passwordBeforeHash);
            $remember = $request->get('remember');
            $user = $repository->findOneBy(array('email' => $username, 'password' => $password));
            
            /* appel du generateur de note du controlleur */
            $noteController = $this->get ( 'noteController' );
            $myGrades = $noteController->indexAction ( $user, $this );
            
            if ($user) {
                if ($remember == 'remember-me') {
                    $login = new Login();
                    $login->setUsername($username);
                    $login->setPassword($password);
                    $session->set('login', $login);
                }
                return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig', array('prenom' => $user->getPrenom(),'nom' => $user->getNom(),'id' => $user, 'myGrades' => $myGrades ));
            } else {
                return $this->render('PolytechDashboardHomeBundle:Default:login.html.twig', array('name' => 'Login Error'));
            }
        
        } else {
        	if ($session->has('login')) {
        		$login = $session->get('login');
        		$username = $login->getUsername();
        		$password = $login->getPassword();
        		$user = $repository->findOneBy(array('email' => $username, 'password' => $password));
        		
        		/* appel du generateur de note du controlleur */
        		$noteController = $this->get ( 'noteController' );
        		$myGrades = $noteController->indexAction ( $user, $this );
        		if ($user) {
        			return $this->render('PolytechDashboardHomeBundle:Default:index.html.twig', array('prenom' => $user->getPrenom(),'nom' => $user->getNom(),'id' => $user, 'myGrades' => $myGrades ));
        		}
        	}
            return $this->render('PolytechDashboardHomeBundle:Default:login.html.twig');
        }
    }

    public function logoutAction(Request $request) {
        $session = $this->getRequest()->getSession();
        $session->clear();
        return $this->render('PolytechDashboardHomeBundle:Default:login.html.twig');
    }

}
